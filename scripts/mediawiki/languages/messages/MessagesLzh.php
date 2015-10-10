<?php
/** Literary Chinese (文言)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author C933103
 * @author Itsmine
 * @author Justincheng12345
 * @author Omnipaedista
 * @author Shinjiman
 * @author Simon Shek
 * @author StephDC
 * @author Super Wang
 * @author Xiaomingyan
 * @author Yanteng3
 */

$specialPageAliases = array(
	'Activeusers'               => array( '躍簿' ),
	'Allmessages'               => array( '官話' ),
	'Allpages'                  => array( '全典' ),
	'Ancientpages'              => array( '陳年' ),
	'Blankpage'                 => array( '白頁' ),
	'Booksources'               => array( '書海' ),
	'BrokenRedirects'           => array( '斷渡' ),
	'Categories'                => array( '類' ),
	'ChangeEmail'               => array( '易郵' ),
	'ChangePassword'            => array( '易符節' ),
	'ComparePages'              => array( '較頁' ),
	'Confirmemail'              => array( '核郵驛' ),
	'Contributions'             => array( '功績' ),
	'CreateAccount'             => array( '增簿' ),
	'Deadendpages'              => array( '此無路也' ),
	'DeletedContributions'      => array( '已刪之積' ),
	'Diff'                      => array( '異' ),
	'DoubleRedirects'           => array( '窮渡' ),
	'EditWatchlist'             => array( '治哨站' ),
	'Emailuser'                 => array( '遺書' ),
	'Export'                    => array( '出匯' ),
	'Fewestrevisions'           => array( '鮮察' ),
	'FileDuplicateSearch'       => array( '擇重檔' ),
	'Filepath'                  => array( '檔路' ),
	'Import'                    => array( '圖入匯' ),
	'Invalidateemail'           => array( '消核郵驛' ),
	'BlockList'                 => array( '列禁簿、禁址' ),
	'LinkSearch'                => array( '尋網連' ),
	'Listfiles'                 => array( '見檔' ),
	'Listgrouprights'           => array( '權任一覽' ),
	'Listredirects'             => array( '表轉' ),
	'Listusers'                 => array( '點簿' ),
	'Lockdb'                    => array( '閉庫' ),
	'Log'                       => array( '誌' ),
	'Lonelypages'               => array( '孤寡' ),
	'Longpages'                 => array( '長言' ),
	'MergeHistory'              => array( '併頁之誌' ),
	'MIMEsearch'                => array( '篩檔' ),
	'Mostcategories'            => array( '跨船' ),
	'Mostimages'                => array( '名檔' ),
	'Mostlinked'                => array( '好料' ),
	'Mostlinkedcategories'      => array( '豪門' ),
	'Mostlinkedtemplates'       => array( '美模' ),
	'Mostrevisions'             => array( '屢審' ),
	'Movepage'                  => array( '遷' ),
	'Mycontributions'           => array( '吾績' ),
	'Mypage'                    => array( '吾頁' ),
	'Mytalk'                    => array( '吾書房' ),
	'Newimages'                 => array( '新圖之廊' ),
	'Newpages'                  => array( '新灶' ),
	'Preferences'               => array( '簿註' ),
	'Prefixindex'               => array( '依名索引' ),
	'Protectedpages'            => array( '頁錮' ),
	'Randompage'                => array( '清風翻書' ),
	'Randomredirect'            => array( '任渡' ),
	'Recentchanges'             => array( '近易' ),
	'Recentchangeslinked'       => array( '援引' ),
	'Search'                    => array( '尋' ),
	'Shortpages'                => array( '短篇' ),
	'Specialpages'              => array( '特查' ),
	'Statistics'                => array( '彙統' ),
	'Uncategorizedcategories'   => array( '問栓' ),
	'Uncategorizedimages'       => array( '候裱' ),
	'Uncategorizedpages'        => array( '欲訂' ),
	'Uncategorizedtemplates'    => array( '待蘸' ),
	'Undelete'                  => array( '覽刪' ),
	'Unlockdb'                  => array( '開庫' ),
	'Unusedcategories'          => array( '樞鏽' ),
	'Unusedimages'              => array( '色褪' ),
	'Unusedtemplates'           => array( '墨乾' ),
	'Unwatchedpages'            => array( '無哨頁' ),
	'Upload'                    => array( '進獻' ),
	'UploadStash'               => array( '貢貯' ),
	'Userlogin'                 => array( '登簿' ),
	'Userlogout'                => array( '去簿' ),
	'Userrights'                => array( '秉治權任' ),
	'Version'                   => array( '版' ),
	'Wantedcategories'          => array( '求門' ),
	'Wantedfiles'               => array( '求檔' ),
	'Wantedpages'               => array( '徵頁' ),
	'Wantedtemplates'           => array( '徵模' ),
	'Watchlist'                 => array( '哨站' ),
	'Whatlinkshere'             => array( '取佐' ),
	'Withoutinterwiki'          => array( '孤語' ),
);

/**
 * A list of date format preference keys which can be selected in user
 * preferences. New preference keys can be added, provided they are supported
 * by the language class's timeanddate(). Only the 5 keys listed below are
 * supported by the wikitext converter (DateFormatter.php).
 *
 * The special key "default" is an alias for either dmy or mdy depending on
 * $wgAmericanDates
 */
$datePreferences = array(
	'default',
	'ISO 8601',
);

$defaultDateFormat = 'zh';

/**
 * These are formats for dates generated by MediaWiki (as opposed to the wikitext
 * DateFormatter). Documentation for the format string can be found in
 * Language.php, search for sprintfDate.
 *
 * This array is automatically inherited by all subclasses. Individual keys can be
 * overridden.
 */
$dateFormats = array(
	'zh time' => 'H時i分',
	'zh date' => 'Y年n月j日 （l）',
	'zh both' => 'Y年n月j日 （D） H時i分',
);

$digitTransformTable = array(
	'0' => '〇',
	'1' => '一',
	'2' => '二',
	'3' => '三',
	'4' => '四',
	'5' => '五',
	'6' => '六',
	'7' => '七',
	'8' => '八',
	'9' => '九',
	'.' => '點',
	',' => '',
);

