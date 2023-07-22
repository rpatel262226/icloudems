<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\CommonFeeCollection;
use App\Models\CommonFeeCollectionHeadwise;
use App\Models\EntryMode;
use App\Models\FeeCategory;
use App\Models\FeeCollectionType;
use App\Models\FeeType;
use App\Models\FinancialTran;
use App\Models\FinancialTransdetail;
use App\Models\Module;
use Illuminate\Support\Str;
use App\Models\CsvTemp;
use DB;



class CsvImport extends Controller
{
    //
    function index(){
        return view('import_file');
    }

    function store(Request $request){
        ini_set('max_execution_time', 0); 
        Branch::truncate();
        CommonFeeCollection::truncate();
        CommonFeeCollectionHeadwise::truncate();
        FeeType::truncate();
        FeeCategory::truncate();
        FeeCollectionType::truncate();
      
        FinancialTran::truncate();
        FinancialTransdetail::truncate();
        


        $upload=$request->file('file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
       
        
        // $csvData = fopen(base_path('database/csv/transaction_report.csv'), 'r');
        $transRow = 'false';
        while (($data = fgetcsv($file)) !== false) {
            // echo "<pre>";
            // print_r($data);
            if(trim($data[0]) == 'Sr.'){
                $transRow = 'true';
            }
            
            if(trim($data[0]) == ''){
                continue;
            }

            if ($transRow == 'true' && $data[0] != 'Sr.') {
                $branchData = $this -> brCheckInsert($data[11]);
                if($branchData){
                    $fcat = $this -> feeCatCheckkIns($data[10],$branchData -> id);
                    
                    if(!empty($fcat)){
                        $fname = $data[16];
                        $fnameUPP = Str::upper($data[16]);
                        if(strpos('FINE', $fnameUPP) !== false || strpos('CONCESSION', $fnameUPP) !== false){
                            $fct = 'Academic Misc';
                        }elseif(strpos('MESS', $fnameUPP) !== false) {
                            $fct = 'Hostel';    
                        } else{
                            $fct = 'Academic';
                        }
                        
                        $fctdata = $this -> feeCoTypeCheckIns($fct,$branchData -> id);
                        $mdata = $this -> modulGet($fct);
                        $ftdata = $this -> FeeType($fcat->id,$fname,$fctdata->id,$branchData -> id,$mdata -> ModuleID);

                        
                        $vType = Str::upper($data[5]);
                        $entCh  = EntryMode::where(['entry_mode_name' => (string)$vType])->first();
                        $rollNo = $data[7];
                        $voucNo = $data[6];
                        $admno = $data[8];
                        
                        if($entCh){
                            $csvColNo =$entCh -> csv_row_num;
                            if($entCh -> table_for_entry == 'financial_trans'){
                            
                                $toc = $entCh -> additional_for_concessionct;
                            
                                $cPar = FinancialTran::where(['admno' => $admno,'brId' => $branchData -> id])->first();
                                $ftdPrimId = 0;
                                if($cPar){
                                    $ftdPrimId = $cPar -> id;
                                    $oldAm = $cPar -> amount;
                                    $newAm = $oldAm + $data[$csvColNo];
                                    $ftdUpd = FinancialTran::where(['id' => $ftdPrimId])->update([
                                        'amount' => $newAm,
                                    ]);
                                }else{
                                    $ftdCrea = FinancialTran::create([
                                        'moduleid' =>$mdata -> ModuleID,
                                        'tranid' => rand(),
                                        'admno' => $data[8],
                                        'amount' => $data[$csvColNo],
                                        'crdr' => $entCh -> crdr,
                                        'tranDate' => $data[1],
                                        'acadYear' => $data[2],
                                        'Entrymode' => $entCh -> entry_mode,
                                        'voucherno' => $data[6],
                                        'brid' => $branchData -> id,
                                        'type_of_concession' => $toc
                                    ]);
                                    $ftdPrimId = $ftdCrea -> id;
                                }    
                                $ftdHCrea = FinancialTransdetail::create([
                                    'financialTranId' => $ftdPrimId,
                                    'moduleId' => $mdata -> ModuleID,
                                    'headId' => $ftdata->id,
                                    'head_name' => $ftdata->f_name,
                                    'amount' => $data[$csvColNo],
                                    'brid' => $branchData -> id,
                                    'crdr' => $entCh -> crdr,
                                ]);    
                            }
    
                            if($entCh -> table_for_entry == 'common_fee_collections'){
                                
                                $checkParEntry = CommonFeeCollection::where(['rollno' => (string)$rollNo,'brId' => $branchData -> id,'PaidDate' => (string)$data[1]])->first();
                                $recId = 0;
                                if($checkParEntry){
                                    $recId = $checkParEntry -> id;
                                    $OldAmount = $checkParEntry -> amount;
                                    $newAmount = $OldAmount + $data[$csvColNo];
                                    CommonFeeCollection::where(['id' => $recId])->update([
                                        'amount' => $newAmount,
                                        'PaidDate' => $data[1],
                                    ]);
                                }else{
                                    $inAct = array('RCPT','PMT','JV');
                                    $Act = array('REVRCPT','REVPMT','REVJV');
                                    $inactive = $entCh -> additional_for_actInact;
                                    
                                    $cfcCrea = CommonFeeCollection::create([
                                        'moduleId' => $mdata -> ModuleID,
                                        'transId' => rand(),
                                        'admno' => $data[8],
                                        'rollno' => $data[7],
                                        'amount' => $data[$csvColNo],
                                        'brId' => $branchData -> id,
                                        'acadamicYear' => $data[2],
                                        'financialYear' => $data[3],
                                        'displayReceiptNo' => $data[15],
                                        'Entrymode' => $entCh -> entry_mode,
                                        'PaidDate' => $data[1],
                                        'inactive' => $inactive,
                                    ]);
                                    $recId = $cfcCrea -> id;
                                }
                                $cfcHCrea = CommonFeeCollectionHeadwise::create([
                                    'moduleId' => $mdata -> ModuleID,
                                    'receiptId' => $recId,
                                    'headId' => $ftdata->id,
                                    'headName' => $ftdata->f_name,
                                    'amount' => $data[$csvColNo],
                                    'brId' => $branchData -> id,
                                ]);
                            } 
                        }

                       
                    
                    }
                    
                }
                
            }
        }
        fclose($file);

        dd('Csv imported successfuly');

    }


    public function brCheckInsert($name=null)
    {
        if($name != null){
            $brCheck = Branch::where('branch_name', Str::title($name))->first();
            if($brCheck){
                return $brCheck;
            }
            $branch = Branch::create([
                'branch_name' => Str::title($name),
            ]);
            return $branch;
            
        }else{
            return null;
        }
        
        
    }
    public function modulGet($name=null)
    {
        if($name != null){
            $md = Module::where('module', Str::title($name))->first();
            if($md){
                return $md;
            }
            
        }else{
            return null;
        }
        
        
    }
    public function feeCatCheckkIns($fcc = null,$bid=null)
    {
        if($bid != null && $fcc != null){
            $FCaCheck = FeeCategory::where(['fee_category' => Str::title($fcc),'br_id' => (int)$bid])->first();
            if($FCaCheck){
                return $FCaCheck;
            }
            $feeCat = FeeCategory::create([
                'fee_category' => Str::title($fcc),
                'br_id' => (int)$bid
            ]);
            return $feeCat;
        }else{
            return null;
        }
    }

    public function feeCoTypeCheckIns($fct = null,$bid=null)
    {
        if($bid != null && $fct != null){
            $FCaCheck = FeeCollectionType::where(['collectionhead' => Str::title($fct),'br_id' => (int)$bid])->first();
            if($FCaCheck){
                return $FCaCheck;
            }
            $dataIn = array(
                [ 'collectionhead' => 'Academic','collectiondesc' =>'Academic','br_id' => (int)$bid ],
                [ 'collectionhead' => 'Academic Misc','collectiondesc' =>'Academic Misc','br_id' => (int)$bid ],
                [ 'collectionhead' => 'Hostel','collectiondesc' =>'Hostel','br_id' => (int)$bid ],
                [ 'collectionhead' => 'Hostel Misc','collectiondesc' =>'Hostel Misc','br_id' => (int)$bid ],
                [ 'collectionhead' => 'Transport','collectiondesc' =>'Transport','br_id' => (int)$bid ],
                [ 'collectionhead' => 'Transport Misc','collectiondesc' =>'Transport Misc','br_id' => (int)$bid ]
            );
            $fcType = FeeCollectionType::insert($dataIn);
            $FCaCheck = FeeCollectionType::where(['collectionhead' => Str::title($fct),'br_id' => (int)$bid])->first();
            if($FCaCheck){
                return $FCaCheck;
            }
            return null;
        }else{
            return null;
        }
    }
    public function FeeType($feeCatId=null,$fname=null,$collectId = null,$brid=null,$Fehetype=null)
    {
            if($feeCatId !== null && $fname !== null && $collectId  !==  null && $brid !== null && $Fehetype !== null){
                
                $ftCh = FeeType::where(['f_name' => Str::title($fname),'br_id' => (int)$brid])->first();
                if($ftCh){
                    return $ftCh;
                }else{
                    $feeCat = FeeType::create([
                        'fee_category' => (int)$feeCatId,
                        'f_name' => Str::title($fname),
                        'Collection_id' => (int)$collectId,
                        'Fee_type_ledger' =>Str::title($fname),
                        'Fee_headtype' => (int)$Fehetype,
                        'fee_category' => (int)$feeCatId,
                        'Seq_id' => 1,
                        'br_id' => (int)$brid
                    ]);
                    return $feeCat;
                }
                
            }else{
                return null;
            }
    }
    // public function ModuleDataInsert()
    // {
    //     $dataIn = array(
    //         [ 'module' => 'Academic','ModuleID' => 1 ],
    //         [ 'module' => 'Academic Misc','ModuleID' => 11 ],
    //         [ 'module' => 'Hostel','ModuleID' => 2 ],
    //         [ 'module' => 'Hostel Misc','ModuleID' => 22 ],
    //         [ 'module' => 'Transport','ModuleID' => 3 ],
    //         [ 'module' => 'Transport Misc','ModuleID' => 33 ]
    //     );
    //     $fcType = Module::insert($dataIn);
    // }

    public function tempInsertCsv(Request $request) {
        ini_set('max_execution_time', 0); 
        CsvTemp::truncate();
        Branch::truncate();
        CommonFeeCollection::truncate();
        CommonFeeCollectionHeadwise::truncate();
        FeeType::truncate();
        FeeCategory::truncate();
        FeeCollectionType::truncate();
      
        FinancialTran::truncate();
        FinancialTransdetail::truncate();
       
        $upload=$request->file('file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
       
        $transRow = 'false';
        $Insdata = array();
        while (($data = fgetcsv($file)) !== false) {
            
            if(trim($data[0]) == 'Sr.'){
                $transRow = 'true';
            }
            
            if(trim($data[0]) == ''){
                continue;
            }

            if ($transRow == 'true' && $data[0] != 'Sr.') {
             
                array_push($Insdata,[
                    'date_c' => $data[1],
                    'academic_year_c' => $data[2],
                    'session_c' => $data[3],
                    'voucher_type_c' => Str::upper($data[5]),
                    'voucher_no_c' => $data[6],
                    'roll_no_c' => $data[7],
                    'admno_c' => $data[8],
                    'fee_category_c' => $data[10],
                    'faculty_c' => $data[11],
                    'receipt_no_c' => $data[15],
                    'fee_head_c' => $data[16],
                    'due_amount_c' => $data[17],
                    'paid_amount_c' => $data[18],
                    'concession_amount_c' => $data[19],
                    'scholarship_amount_c' => $data[20],
                    'reverse_concession_amount_c' => $data[21],
                    'write_off_amount_c' => $data[22],
                    'adjusted_amount_c' => $data[23],
                    'refund_amount_c' => $data[24],
                    'fund_tranCfer_amount_c' => $data[25]
                   ]);
            }
        }
        
       
        try {
            $chunkSize = 500;
            
            foreach (array_chunk($Insdata, $chunkSize) as $chunk) {
                
                CsvTemp::insert($chunk);
                
            }
            $callProc = DB::select('call csvImpTodb()');
            echo "ok";
          } catch (Exception $e) {
            return json_encode($e);
           
          }
         
       
    }

}
