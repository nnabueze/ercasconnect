<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function  __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('user_id'))
		{  
			redirect(getUrl('login'));
		}
        $this->load->model(array('user_model','reports_model','biller_model','basic_model'));
		$this->load->library('form_validation');
	} 

	public function index()
	{		
		if(!isAdminLoggedIn())
		{
			$this->session->set_flashdata('errors', 'You dont have permission to access this part of the site.');
			redirect(getUrl('apperror'));
		}
		$data= array();
		$data['page_title'] = 'Client Report Module';
		$data['menu'] = 'reports';
		$data['sub_menu'] = 'table';
		//$data =  $this->reports_model->report(); 
		$this->load->view('reports',$data);
	}

	public function graphicreport()
	{		
		if($this->input->post('biller_srch')!=''){
		
		}		
		$data               = array();
		$data['page_title'] = 'Client Report Module';
		$data['analysisarr'] =  $this->reports_model->report(); 
		$this->load->view('graphicreport',$data);
	}

	function cd_list() {
        $results = $this->reports_model->get_cd_list();
        echo json_encode($results);
    }
	
	function analysis(){ 
		$data['page_title'] = 'Client Report Module';
		$data['menu'] = 'reports';
		$data['sub_menu'] = 'graph';
		$bilerid = 1;
		$analysisdata =array();
		
		/*print_r($analysisdata);
		$anastr ='';
		foreach($analysisdata as $sdata){
				$anastr .= '['.$sdata->datetimestamp.', '.str_replace(",",'',$sdata->PaidAmount).'] ,';
		} */
		
		if($this->input->post('biller_srch')!=''){
			//print_r($_POST);

			//$startdate = explode()
			$billertbl = $this->input->post('billertbl');
			$billerid = $this->input->post('biller_srch');
			$dateto = $this->input->post('dateto');
			$datefrm = $this->input->post('datefrm');
			$data['biller_srch'] = $this->input->post('biller_srch');
			$data['billertbl'] = $billertbl;
			$data['dateto'] = $dateto;
			$data['datefrm'] = $datefrm;
			$data['billername'] = $this->biller_model->biller_name($billerid);
			$data['ercas_service'] = $this->biller_model->get_ercas_service($billertbl);
			$analysisdata =  $this->reports_model->generate_analysis_data($billertbl,$dateto,$datefrm);
		
		} else {
			$data['biller_srch'] = $this->input->post('biller_srch');
			$data['billertbl'] = $billertbl;
			$data['dateto'] = $dateto;
			$data['datefrm'] = $datefrm;
		}
		
		$data['grapharr'] = $analysisdata; 
		
	
		/*$arr = array();
		$arr[0] = array('I',20);
		$arr[1] = array('II',30);
		$arr[2] = array('III',40);
		$arr[3] = array('IV',35);
		$arr[4] = array('V',70);
		$arr[5] = array('VI',90);
		$arr[6] = array('VII',100);
		$arr[7] = array('VIII',120);
		$arr[8] = array('IX',200);
		$arr[9] = array('X',60);
		$data['grapharr'] = $arr; */
		$this->load->view('graphicreport-',$data);
	}
	
	public function parse_data(){
		echo	$string = '{
		  "draw": 1,
		  "recordsTotal": 57,
		  "recordsFiltered": 57,
		  "data": [
			[
			  "Airi",
			  "Satou",
			  "Accountant",
			  "Tokyo",
			  "28th Nov 08",
			  "$162,700"
			],
			[
			  "Angelica",
			  "Ramos",
			  "Chief Executive Officer (CEO)",
			  "London",
			  "9th Oct 09",
			  "$1,200,000"
			],
			[
			  "Ashton",
			  "Cox",
			  "Junior Technical Author",
			  "San Francisco",
			  "12th Jan 09",
			  "$86,000"
			],
			[
			  "Bradley",
			  "Greer",
			  "Software Engineer",
			  "London",
			  "13th Oct 12",
			  "$132,000"
			],
			[
			  "Brenden",
			  "Wagner",
			  "Software Engineer",
			  "San Francisco",
			  "7th Jun 11",
			  "$206,850"
			],
			[
			  "Brielle",
			  "Williamson",
			  "Integration Specialist",
			  "New York",
			  "2nd Dec 12",
			  "$372,000"
			],
			[
			  "Bruno",
			  "Nash",
			  "Software Engineer",
			  "London",
			  "3rd May 11",
			  "$163,500"
			],
			[
			  "Caesar",
			  "Vance",
			  "Pre-Sales Support",
			  "New York",
			  "12th Dec 11",
			  "$106,450"
			],
			[
			  "Cara",
			  "Stevens",
			  "Sales Assistant",
			  "New York",
			  "6th Dec 11",
			  "$145,600"
			],
			[
			  "Cedric",
			  "Kelly",
			  "Senior Javascript Developer",
			  "Edinburgh",
			  "29th Mar 12",
			  "$433,060"
			]
		  ]
		}';	
	}

	public function biller_search($tblname,$to='',$from=''){
		//$tblname = $_POST['tblnm'];
	/*	print_r($tblname);
		die;
*/		$results = $this->reports_model->get_cd_list($tblname,$to,$from);
		echo json_encode($results);
		
		exit;
	}
	

	public function getbillertable(){
		if($this->input->post('billerid')!=''){			
			$data['biller_srch_id']   = $this->input->post('billerid');
			$billdt = $this->biller_model->biller_detail($data['biller_srch_id']);
		//	print_R($billdt);
			$data1 = '';
			$biller_acronymn = $billdt[0]->biller_acronymn;
			$data1 = '<option value="">Select Table</option>';
			if($billdt[0]->service_bank_ebills=='1'){
				$data1 .= '<option value="payment_collection_'.$biller_acronymn.'">ERCASPay</option>';
			}
			if($billdt[0]->service_cashpoint=='1'){
				$data1 .= '<option value="payment_pos_'.$biller_acronymn.'">ERCASPOS</option>';
			}
			if($billdt[0]->service_centralpay_ecommerce=='1'){
				$data1 .= '<option value="payment_ecommerce_'.$biller_acronymn.'">ERCASCentral</option>';
			}
			echo $data1;
		}
	}

	function readCSV($csvFile){
			$file_handle = fopen($csvFile, 'r');
			while (!feof($file_handle) ) {
				$line_of_text[] = fgetcsv($file_handle, 1024);
			}
			fclose($file_handle);
			return $line_of_text;
		} 	 	

	public function readcsvfile(){
		
		// Set path to CSV file
		$csvFile = 'C:/wamp/www/Book2.csv';
		$csv = $this->readCSV($csvFile);
		$i=0;

		foreach($csv as $csvfile){
			$save = array();
			echo $i."==aa<br/>";
			if($i==0){$i++;continue;}
			//$save['id'] = $csvfile[0];
			$save['billerID'] = $csvfile[1];
			$save['MerchantID'] = $csvfile[2];
			$save['TransactionID'] = $csvfile[3];
			$save['TransDate'] = $csvfile[4];
			$save['PaidAmount'] = $csvfile[5];
			$save['PaymentTerminalID'] = $csvfile[6];
			$save['DestinationBank'] = $csvfile[7];
			$save['CustomerID'] = $csvfile[8];
			$save['CustomerName'] = $csvfile[9];
			$save['CustomerPhone'] = $csvfile[10];
			$save['CustomerEmail'] = $csvfile[11];
			$save['TransactionStatus'] = $csvfile[12];
			$this->basic_model->savedata('payment_pos_ewrw',$save);			
		}
	
	}

	public function readcollectionfile(){
		
		// Set path to CSV file
		$csvFile = 'C:/wamp/www/Book3.csv';
		$csv = $this->readCSV($csvFile);
		$i=0;

		foreach($csv as $csvfile){
			$save = array();
			echo $i."==aa<br/>";
			if($i==0){$i++;continue;}
			//$save['id'] = $csvfile[0];
			$save['billerID'] = $csvfile[1];
			$save['MerchantID'] = $csvfile[2];
			$save['TransactionID'] = $csvfile[3];
			$save['TransDate'] = $csvfile[4];
			$save['PaidAmount'] = $csvfile[5];
			$save['SourceBank'] = $csvfile[6];
			$save['DestinationBank'] = $csvfile[7];
			$save['CustomerID'] = $csvfile[8];
			$save['CustomerName'] = $csvfile[9];
			$save['CustomerPhone'] = $csvfile[10];
			$save['CustomerEmail'] = $csvfile[11];
			$save['TransactionStatus'] = $csvfile[12];
			$this->basic_model->savedata('payment_collection_ewrw',$save);			
		}
		echo "<pre>";print_r($csv);echo "</pre>";
	}
}

/* End of file reports.php */
/* Location: ./application/controllers/reports.php */