<?php

namespace CompanyReview;

class CompanyReview{

	/**
	* Gets a file in the given path
	*
	* @param string $path The path where to fetch the file
	*
	* @return string $file The contents of the file
	*/
	public function getData($path){
		$file = @file_get_contents($path);		
		if($file === false){
			throw new \Exception("File Not Found");
		}
		return $file;
	}

	/**
	* Gets all the companies information from a db file
	*
	* @return array $arrayFile All companies information
	*/
	public function getAllCompanies(){
		$path="../db/data.json";
		$file=$this->getData($path);
	
		$arrayFile = json_decode($file, true);
	
		return $arrayFile['companies'];
	}

	/**
	* Gets all the companies avegrage ratings
	*
	* @return json $companiesRatings Json array with all companies and their average ratings
	*/
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

	/**
	* Given a full company information retrieves their ratings
	*
	* @param string $company The company to fetch the ratings
	*
	* @return arrary $reviews['rating'] The ratings for the company
	*/
	public function getCompanyRatings($company){

		foreach($company['reviews'] as $reviews){
			return $reviews['rating'];
		}

	}

	/**
	* Given a full company information retrieves their reviewers 
	*
	* @param string $company The company to fetch the reviewers
	*
	* @return arrary $reviewers The reviewers for the company
	*/
	public function getArrayReviewers($company){
		
		foreach($company['reviews'] as $review){
			$reviewers[] = $review['user'];
		}
		return $reviewers;
	}

	/**
	* Given a company ratings, calculate their averages 
	*
	* @param array $ratings The company complete ratings
	*
	* @return arrary  The average ratings for the company
	*/
	public function getCompanyAverageRatings($ratings){

		$total=count($ratings);
		$culture=$management=$work_live_balance=$career_development=0;

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

	/**
	* Given a full company slug, fetches its data 
	*
	* @param string $companySlug The company to fetch the data
	*
	* @return json The company data
	*/
	public function getCompany($companySlug){
	
		$companies=$this->getAllCompanies();

		foreach($companies as $company){
			if($company['slug'] == $companySlug){
			return $this->returnCompanyData($company);
			}
		}	
		return 'Company Not Found.';
	}

	/**
	* Given a full company data, composes an array with relevant information 
	*
	* @param array $company The company data
	*
	* @return json The new company data array
	*/
	public function returnCompanyData($company){

		$data = array('name'=>$company['name'], 'city'=>$company['city'], 'reviews'=>$company['reviews']);
		return json_encode($data);
	}

	/**
	* Given a full company slug, gets a 'users who reviewed this also reviewed' array
	*
	* @param array $companySlug The company slug
	*
	* @return json An array of companies
	*/
	public function getMoreReviews($companySlug){
		
		$reviewers = $this->getCompanyReviewers($companySlug);
		
		if($reviewers == "Company Not Found."){
			return $reviewers;
		}

		if(!empty($reviewers)){
			$companies = $this->getCompaniesReviewedByUsers($reviewers);
			$companies = array_unique($companies);
			return json_encode($companies);
		}
		return "This company has no reviews yet.";
	}

	/**
	* Given a full company slug, gets all users that reviewed the company
	*
	* @param string $companySlug The company slug
	*
	* @return array An array with all users who reviewed the company
	*/
	public function getCompanyReviewers($companySlug){
		$companies = $this->getAllCompanies();

		foreach($companies as $company){
			if($company['slug'] == $companySlug){
				return $reviewers = $this->getArrayReviewers($company);
			}
		}
		return 'Company Not Found.';
	}


	/**
	* Given a users list, gets all comapnies reviewed by those users 
	*
	* @param array $users An array of users
	*
	* @return array An array with all companies reviewed by the users
	*/
	public function getCompaniesReviewedByUsers($users){

		foreach($users as $user){
			$companies = $this->getAllCompanies();
			foreach($companies as $company){
				$reviewed = $this->checkUserReview($user, $company);

				if($reviewed){
					$companyList[] = $company['name'];
				}
			}
		}
		return $companyList;	

	}

	/**
	* Given a user and a company, checks if the user reviewed the company
	*
	* @param string $user The user to check
	* @param string $company The company to check
	*
	* @return boolean If the user reviewed the company or not
	*/
	public function checkUserReview($user, $company){

		foreach($company['reviews'] as $reviews){
			if($reviews['user'] == $user){
				return true;
			}
		}
		return false;
	}
}
