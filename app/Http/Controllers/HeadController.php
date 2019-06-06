<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\tableheading;
use App\tabledatas;

use Google_Client;
use Google_Service_Drive;
use League\Csv\Reader;

class HeadController extends Controller
{
    public function tableheadfetch(Request $request){
		$tableheading=tableheading::get();
    	$tablevalues=tabledatas::orderBy('row_id')->get();
    
    	
    	$client = new Google_Client();
		putenv('GOOGLE_APPLICATION_CREDENTIALS='.storage_path().'/googleservice.json');
		$client->useApplicationDefaultCredentials();
		$client->addScope(Google_Service_Drive::DRIVE);
		$driveService = new Google_Service_Drive($client);
		//$response = $driveService->files->listFiles();
		$fileID = '1aS8LQKEkB_pnFfaFkeN_cQs5q9AB4A-aNqMj512TgfE';
		$response = $driveService->files->export($fileID, 'text/csv', array('alt' => 'media'));
		$content = $response->getBody()->getContents();
		$csv = Reader::createFromString($content, 'r');
		$csv->setHeaderOffset(0);
		$records = $csv->getRecords();
		$newarray = array();
		foreach ($records as $value) {
		    $newarray[] = $value;
		}

		return view('welcome', compact('tableheading', 'tablevalues',    'newarray'));
    }

    public function update() {
    }
}
