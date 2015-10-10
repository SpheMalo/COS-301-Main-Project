<?php

class DiffHistoryBlobTest extends MediaWikiTestCase {

	protected function setUp() {
		parent::setUp();

		$this->checkPHPExtension( 'hash' );
		$this->checkPHPExtension( 'xdiff' );

		if ( !function_exists( 'xdiff_string_rabdiff' ) ) {
			$this->markTestSkipped( 'The version of xdiff extension is lower than 1.5.0' );

			return;
		}
	}

	/**
	 * Test for DiffHistoryBlob::xdiffAdler32()
	 * @dataProvider provideXdiffAdler32
	 * @covers DiffHistoryBlob::xdiffAdler32
	 */
	public function testXdiffAdler32( $input ) {
		$xdiffHash = substr( xdiff_string_rabdiff( $input, '' ), 0, 4 );
		$dhb = new DiffHistoryBlob;
		$myHash = $dhb->xdiffAdler32( $input );
		$this->assertSame( bin2hex( $xdiffHash ), bin2hex( $myHash ),
			"Hash of " . addcslashes( $input, "\0..\37!@\@\177..\377" ) );
	}

	public static function provideXdiffAdler32() {
		return array(
			array( '', 'Empty string' ),
			array( "\0", 'Null' ),
			array( "\0\0\0", "Several nulls" ),
			array( "Hello", "An ASCII string" ),
			array( str_repeat( "x", 6000 ), "A string larger than xdiff's NMAX (5552)" )
		);
	}
}
