<?php

namespace CompanyReview;

class CompanyReview{

	public function getData(){
	
		$path = "../db/data.json";
		$file = file_get_contents($path);

		if($file === false){
			throw new FileNotFoundException;
		}
		return $file;
	}

}
