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

    

    public function store(Request $request) {
        ini_set('max_execution_time', 0); 
        CsvTemp::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Branch::truncate();
            Branch::truncate();
            CommonFeeCollection::truncate();
            CommonFeeCollectionHeadwise::truncate();
            FeeType::truncate();
            FeeCategory::truncate();
            FeeCollectionType::truncate();
            FinancialTran::truncate();
            FinancialTransdetail::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

       
       
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
            $chunkSize = 200;
            
            foreach (array_chunk($Insdata, $chunkSize) as $chunk) {
                CsvTemp::insert($chunk);
                $callProc = DB::select('call csvImpTodb()');
                DB::table('csv_temp')->delete();
            }
            echo "ok";
          } catch (Exception $e) {
            return json_encode($e);
           
          }
         
       
    }

}
