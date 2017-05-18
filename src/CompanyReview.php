<?php

namespace CompanyReview;

class CompanyReview{

	public function getData($path){
		$file = @file_get_contents($path);		
		if($file === false){
			throw new \Exception("File Not Found");
		}
		return $file;
	}

	public function getAllCompanies(){
		$path="../db/data.json";
		$file=$this->getData($path);
	
		$arrayFile = json_decode($file, true);
	
		return $arrayFile['companies'];
	}


	public function getCompaniesAvrRatings(){
		$companies = $this->getAllCompanies();

		foreach($companies as $company){
			$ratings[] = $this->getCompanyRatings($company);
			$avgRatings = $this->getCompanyAverageRatings($ratings);
			$fullRating = array('name'=>$company['name'], 'slug'=>$company['slug'], 'AverageRatings'=>$avgRatings);
			$companiesRatings[]=$fullRating;

		}
		return json_encode($companiesRatings);
	}

	public function getCompanyRatings($company){

		foreach($company['reviews'] as $reviews){
			return $reviews['rating'];
		}

	}

	public function getCompanyAverageRatings($ratings){

		$total=count($ratings);
		foreach($ratings as $rating){
			$culture += $rating['culture'];
		    $management += $rating['management'];
			$work_live_balance += $rating['work_live_balance'];
			$career_development += $rating['career_development'];	
		}	
		
		$avgCulture = $culture/$total;
		$avgManagement = $management/$total;
		$avgWork_live = $work_live_balance/$total;
		$avgCareer_dev = $career_development/$total;

		return array('culture'=>$avgCulture, 'management'=>$avgManagement, 'work_live_balance'=>$avgWork_live, 'career_development'=>$avgCareer_dev);
	}

	public function getCompany($companySlug){
	
		$companies=$this->getAllCompanies();

		foreach($companies as $company){
			if($company['slug'] == $companySlug){
			return $this->returnCompanyData($company);
			}
		}	
		return 'Company Not Found.';
	}


	public function returnCompanyData($company){

		//filter company information and return it in json format
		$data = array('name'=>$company['name'], 'city'=>$company['city'], 'reviews'=>$company['reviews']);
		return json_encode($data);
	}

}
