<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @since 1.23
 */

/**
 * Recent changes feed.
 *
 * @ingroup API
 */
class ApiFeedRecentChanges extends ApiBase {

	/**
	 * This module uses a custom feed wrapper printer.
	 *
	 * @return ApiFormatFeedWrapper
	 */
	public function getCustomPrinter() {
		return new ApiFormatFeedWrapper( $this->getMain() );
	}

	/**
	 * Format the rows (generated by SpecialRecentchanges or SpecialRecentchangeslinked)
	 * as an RSS/Atom feed.
	 */
	public function execute() {
		$config = $this->getConfig();

		$this->params = $this->extractRequestParams();

		if ( !$config->get( 'Feed' ) ) {
			$this->dieUsage( 'Syndication feeds are not available', 'feed-unavailable' );
		}

		$feedClasses = $config->get( 'FeedClasses' );
		if ( !isset( $feedClasses[$this->params['feedformat']] ) ) {
			$this->dieUsage( 'Invalid subscription feed type', 'feed-invalid' );
		}

		$this->getMain()->setCacheMode( 'public' );
		if ( !$this->getMain()->getParameter( 'smaxage' ) ) {
			// bug 63249: This page gets hit a lot, cache at least 15 seconds.
			$this->getMain()->setCacheMaxAge( 15 );
		}

		$feedFormat = $this->params['feedformat'];
		$specialClass = $this->params['target'] !== null
			? 'SpecialRecentchangeslinked'
			: 'SpecialRecentchanges';

		$formatter = $this->getFeedObject( $feedFormat, $specialClass );

		// Everything is passed implicitly via $wgRequest… :(
		// The row-getting functionality should maybe be factored out of ChangesListSpecialPage too…
		$rc = new $specialClass();
		$rows = $rc->getRows();

		$feedItems = $rows ? ChangesFeed::buildItems( $rows ) : array();

		ApiFormatFeedWrapper::setResult( $this->getResult(), $formatter, $feedItems );
	}

	/**
	 * Return a ChannelFeed object.
	 *
	 * @param string $feedFormat Feed's format (either 'rss' or 'atom')
	 * @param string $specialClass Relevant special page name (either 'SpecialRecentchanges' or
	 *     'SpecialRecentchangeslinked')
	 * @return ChannelFeed
	 */
	public function getFeedObject( $feedFormat, $specialClass ) {
		if ( $specialClass === 'SpecialRecentchangeslinked' ) {
			$title = Title::newFromText( $this->params['target'] );
			if ( !$title ) {
				$this->dieUsageMsg( array( 'invalidtitle', $this->params['target'] ) );
			}

			$feed = new ChangesFeed( $feedFormat, false );
			$feedObj = $feed->getFeedObject(
				$this->msg( 'recentchangeslinked-title', $title->getPrefixedText() )
					->inContentLanguage()->text(),
				$this->msg( 'recentchangeslinked-feed' )->inContentLanguage()->text(),
				SpecialPage::getTitleFor( 'Recentchangeslinked' )->getFullURL()
			);
		} else {
			$feed = new ChangesFeed( $feedFormat, 'rcfeed' );
			$feedObj = $feed->getFeedObject(
				$this->msg( 'recentchanges' )->inContentLanguage()->text(),
				$this->msg( 'recentchanges-feed-description' )->inContentLanguage()->text(),
				SpecialPage::getTitleFor( 'Recentchanges' )->getFullURL()
			);
		}

		return $feedObj;
	}

	public function getAllowedParams() {
		$config = $this->getConfig();
		$feedFormatNames = array_keys( $config->get( 'FeedClasses' ) );

		$ret = array(
			'feedformat' => array(
				ApiBase::PARAM_DFLT => 'rss',
				ApiBase::PARAM_TYPE => $feedFormatNames,
			),

			'namespace' => array(
				ApiBase::PARAM_TYPE => 'namespace',
			),
			'invert' => false,
			'associated' => false,

			'days' => array(
				ApiBase::PARAM_DFLT => 7,
				ApiBase::PARAM_MIN => 1,
				ApiBase::PARAM_TYPE => 'integer',
			),
			'limit' => array(
				ApiBase::PARAM_DFLT => 50,
				ApiBase::PARAM_MIN => 1,
				ApiBase::PARAM_MAX => $config->get( 'FeedLimit' ),
				ApiBase::PARAM_TYPE => 'integer',
			),
			'from' => array(
				ApiBase::PARAM_TYPE => 'timestamp',
			),

			'hideminor' => false,
			'hidebots' => false,
			'hideanons' => false,
			'hideliu' => false,
			'hidepatrolled' => false,
			'hidemyself' => false,

			'tagfilter' => array(
				ApiBase::PARAM_TYPE => 'string',
			),

			'target' => array(
				ApiBase::PARAM_TYPE => 'string',
			),
			'showlinkedto' => false,
		);

		if ( $config->get( 'AllowCategorizedRecentChanges' ) ) {
			$ret += array(
				'categories' => array(
					ApiBase::PARAM_TYPE => 'string',
					ApiBase::PARAM_ISMULTI => true,
				),
				'categories_any' => false,
			);
		}

		return $ret;
	}

	protected function getExamplesMessages() {
		return array(
			'action=feedrecentchanges'
				=> 'apihelp-feedrecentchanges-example-simple',
			'action=feedrecentchanges&days=30'
				=> 'apihelp-feedrecentchanges-example-30days',
		);
	}
}
