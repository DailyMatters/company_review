<?php

namespace CompanyReview;

class CompanyReview{

	public function getData($path){
	
		//$path = "../db/data.json";
		//$file = file_get_contents($path);

		if(file_get_contents($path) === false){
			throw new FileNotFoundException;
		}
		return $file;
	}

}
