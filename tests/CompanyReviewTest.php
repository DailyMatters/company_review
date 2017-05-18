<?php

use PHPUnit\Framework\TestCase;
use CompanyReview\CompanyReview;
require "./src/FileNotFoundException.php";

class CompanyReviewTest extends TestCase {

	private $review;

	protected function setUp(){
		$this->review = new CompanyReview();
	}

	public function testGetFileThrowsException(){
		$this->expectException(FileNotFoundException::class);
		$file = "db.json";
		$this->review->getData($file);
	}

}
