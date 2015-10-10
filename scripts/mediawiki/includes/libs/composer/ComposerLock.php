<?php

/**
 * Reads a composer.lock file and provides accessors to get
 * its hash and what is installed
 *
 * @since 1.25
 */
class ComposerLock {

	/**
	 * @param string $location
	 */
	public function __construct( $location ) {
		$this->contents = json_decode( file_get_contents( $location ), true );
	}

	public function getHash() {
		return $this->contents['hash'];
	}

	/**
	 * Dependencies currently installed according to composer.lock
	 *
	 * @return array
	 */
	public function getInstalledDependencies() {
		$deps = array();
		foreach ( $this->contents['packages'] as $installed ) {
			$deps[$installed['name']] = array(
				'version' => ComposerJson::normalizeVersion( $installed['version'] ),
				'type' => $installed['type'],
			);
		}

		return $deps;
	}
}
