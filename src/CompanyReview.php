<?php

namespace CompanyReview;

class CompanyReview{

	public function getData($path){
	
		if($file = @file_get_contents($path) === false){
			throw new \Exception("File Not Found");
		}
		return $file;
	}

}
