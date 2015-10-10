<?php
/** Ossetic (Ирон)
 *
 * To improve a translation please visit https://translatewiki.net
 *
 * @ingroup Language
 * @file
 *
 * @author Amikeco
 * @author Amire80
 * @author Bouron
 * @author HalanTul
 * @author לערי ריינהארט
 */

$fallback = 'ru';

$namespaceNames = array(
	NS_MEDIA            => 'Медиа',
	NS_SPECIAL          => 'Сæрмагонд',
	NS_TALK             => 'Тæрхон',
	NS_USER             => 'Архайæг',
	NS_USER_TALK        => 'Архайæджы_ныхас',
	NS_PROJECT_TALK     => '{{GRAMMAR:genitive|$1}}_тæрхон',
	NS_FILE             => 'Файл',
	NS_FILE_TALK        => 'Файлы_тæрхон',
	NS_MEDIAWIKI        => 'MediaWiki',
	NS_MEDIAWIKI_TALK   => 'MediaWiki-йы_тæрхон',
	NS_TEMPLATE         => 'Хуызæг',
	NS_TEMPLATE_TALK    => 'Хуызæджы_тæрхон',
	NS_HELP             => 'Æххуыс',
	NS_HELP_TALK        => 'Æххуысы_тæрхон',
	NS_CATEGORY         => 'Категори',
	NS_CATEGORY_TALK    => 'Категорийы_тæрхон',
);

$namespaceAliases = array(
	'Дискусси'                    => NS_TALK,
	'Архайæджы_дискусси'          => NS_USER_TALK,
	'Дискусси_$1'                 => NS_PROJECT_TALK,
	'Ныв'                         => NS_FILE,
	'Нывы_тæрхон'                 => NS_FILE_TALK,
	'Нывы_тыххæй_дискусси'        => NS_FILE_TALK,
	'Дискусси_MediaWiki'          => NS_MEDIAWIKI_TALK,
	'Тæрхон_MediaWiki'            => NS_MEDIAWIKI_TALK,
	'Шаблон'                      => NS_TEMPLATE,
	'Шаблоны_тæрхон'              => NS_TEMPLATE_TALK,
	'Шаблоны_тыххæй_дискусси'     => NS_TEMPLATE_TALK,
	'Æххуысы_тыххæй_дискусси'     => NS_HELP_TALK,
	'Категорийы_тыххæй_дискусси'  => NS_CATEGORY_TALK,
);

$specialPageAliases = array(
	'Activeusers'               => array( 'АктивонАрхайджытæ' ),
	'Allmessages'               => array( 'ФыстæджытæИууылдæр' ),
	'Allpages'                  => array( 'ФæрстæИууылдæр' ),
	'Ancientpages'              => array( 'ЗæрондФæрстæ' ),
	'Badtitle'                  => array( 'Æвзæрном' ),
	'Blankpage'                 => array( 'АфтидФарс' ),
	'Block'                     => array( 'Блок' ),
	'Booksources'               => array( 'ЧингуытыРавзæрæнтæ' ),
	'BrokenRedirects'           => array( 'ЦъæлРарвыстытæ' ),
	'Categories'                => array( 'Категоритæ' ),
	'ChangeEmail'               => array( 'EmailИвын' ),
	'ChangePassword'            => array( 'ПарольИвын' ),
	'ComparePages'              => array( 'ФæрстæАбарын' ),
	'Confirmemail'              => array( 'EmailБæлвырдКæнын' ),
	'Contributions'             => array( 'Бавæрд' ),
	'CreateAccount'             => array( 'АккаунтСкæнын' ),
	'Deadendpages'              => array( 'ХæдбарФæрстæ' ),
	'DeletedContributions'      => array( 'ХафтБавæрд' ),
	'DoubleRedirects'           => array( 'ДывæрÆрвыстытæ' ),
	'EditWatchlist'             => array( 'ЦæстдардИвын' ),
	'Emailuser'                 => array( 'АрхайæгмæEmail' ),
	'Export'                    => array( 'Экспорт' ),
	'Fewestrevisions'           => array( 'ЦъусдæрФæлтæртæ' ),
	'FileDuplicateSearch'       => array( 'ФайлыДубликатАгурын' ),
	'Filepath'                  => array( 'ФайлмæФæт' ),
	'Import'                    => array( 'Импорт' ),
	'Invalidateemail'           => array( 'EmailРабæлвырдКæнын' ),
	'JavaScriptTest'            => array( 'JavaScriptТест' ),
	'BlockList'                 => array( 'Блокты_Номхыгъд' ),
	'LinkSearch'                => array( 'ÆрвитæнАгурын' ),
	'Listadmins'                => array( 'РадгæстыНомхыгъд' ),
	'Listbots'                  => array( 'БоттыНомхыгъд' ),
	'Listfiles'                 => array( 'НывтыНомхыгъд' ),
	'Listgrouprights'           => array( 'АрхайджытыБартыНомхыгъд' ),
	'Listredirects'             => array( 'ÆрвыстытыНомхыгъд' ),
	'Listusers'                 => array( 'АрхайджытыНомхыгъд' ),
	'Lockdb'                    => array( 'РДСæхгæнын' ),
	'Log'                       => array( 'Логтæ' ),
	'Lonelypages'               => array( 'ИунæгФæрстæ' ),
	'Longpages'                 => array( 'ДаргъФæрстæ' ),
	'MergeHistory'              => array( 'ИсторитæБаиуКæнын' ),
	'MIMEsearch'                => array( 'MIMEАгурын' ),
	'Mostcategories'            => array( 'ФылдæрКатегоритæ' ),
	'Mostimages'                => array( 'ÆппæтыАрхайдФайлтæ' ),
	'Mostinterwikis'            => array( 'ФылдæрИнтервикитæ' ),
	'Mostlinked'                => array( 'ФылдæрБастФæрстæ' ),
	'Mostlinkedcategories'      => array( 'ФылдæрБастКатегоритæ' ),
	'Mostlinkedtemplates'       => array( 'ФылдæрБастХуызæгтæ' ),
	'Mostrevisions'             => array( 'ФылдæрФæлтæртæ' ),
	'Movepage'                  => array( 'ФарсХæссын' ),
	'Mycontributions'           => array( 'МæБавæрд' ),
	'Mypage'                    => array( 'МæФарс' ),
	'Mytalk'                    => array( 'МæНыхас' ),
	'Myuploads'                 => array( 'МæБавгæд' ),
	'Newimages'                 => array( 'НогФайлтæ' ),
	'Newpages'                  => array( 'НогФæрстæ' ),
	'PasswordReset'             => array( 'ПарольНогКæнын' ),
	'PermanentLink'             => array( 'УдгасÆрвитæн' ),
	'Popularpages'              => array( 'АрæхФæрстæ' ),
	'Preferences'               => array( 'Уагæвæрдтæ' ),
	'Prefixindex'               => array( 'РазæфтуантыИндекс' ),
	'Protectedpages'            => array( 'ÆхгæдФæрстæ' ),
	'Protectedtitles'           => array( 'ÆхгæдНæмттæ' ),
	'Randompage'                => array( 'ÆрхаугæФарс' ),
	'Randomredirect'            => array( 'ÆрхаугæРарвыст' ),
	'Recentchanges'             => array( 'ФæстагИвдтытæ' ),
	'Recentchangeslinked'       => array( 'БастИвдтытæ' ),
	'Revisiondelete'            => array( 'ИвдХафын' ),
	'Search'                    => array( 'Агурын' ),
	'Shortpages'                => array( 'ЦыбырФæрстæ' ),
	'Specialpages'              => array( 'СæрмагондФæрстæ' ),
	'Statistics'                => array( 'Статистикæ' ),
	'Tags'                      => array( 'Тегтæ' ),
	'Unblock'                   => array( 'РаблокКæнын' ),
	'Uncategorizedcategories'   => array( 'ÆнæКатегориКатегоритæ' ),
	'Uncategorizedimages'       => array( 'ÆнæКатегориФайлтæ' ),
	'Uncategorizedpages'        => array( 'ÆнæКатегориФæрстæ' ),
	'Uncategorizedtemplates'    => array( 'ÆнæКатегориХуызæгтæ' ),
	'Undelete'                  => array( 'Рацаразын' ),
	'Unlockdb'                  => array( 'РДРаблокКæнын' ),
	'Unusedcategories'          => array( 'ÆнæАрхайдКатегоритæ' ),
	'Unusedimages'              => array( 'ÆнæАрхайдФайлтæ' ),
	'Unusedtemplates'           => array( 'ÆнæАрхайдХуызæгтæ' ),
	'Unwatchedpages'            => array( 'ÆнæЦæстдардФæрстæ' ),
	'Upload'                    => array( 'Æвгæнын' ),
	'Userlogin'                 => array( 'Бахизын' ),
	'Userlogout'                => array( 'Рахизын' ),
	'Userrights'                => array( 'АрхайæджыБартæ' ),
	'Version'                   => array( 'Фæлтæр' ),
	'Wantedcategories'          => array( 'ХъæугæКатегоритæ' ),
	'Wantedfiles'               => array( 'ХъæугæФайлтæ' ),
	'Wantedpages'               => array( 'ХъæугæФæрстæ' ),
	'Wantedtemplates'           => array( 'ХъæугæХуызæгтæ' ),
	'Watchlist'                 => array( 'Цæстдард' ),
	'Whatlinkshere'             => array( 'АрдæмЦыÆрвиты' ),
	'Withoutinterwiki'          => array( 'ÆнæИнтервики' ),
);


$magicWords = array(
	'redirect'                  => array( '0', '#ÆРВИТÆН', '#ÆРВЫСТ', '#РАРВЫСТ', '#перенаправление', '#перенапр', '#REDIRECT' ),
	'notoc'                     => array( '0', '__ÆНÆСÆР__', '__БЕЗ_ОГЛАВЛЕНИЯ__', '__БЕЗ_ОГЛ__', '__NOTOC__' ),
	'nogallery'                 => array( '0', '__ÆНÆГАЛЕРЕЙ__', '__БЕЗ_ГАЛЕРЕИ__', '__NOGALLERY__' ),
	'forcetoc'                  => array( '0', '__СÆРТИМÆ__', '__ОБЯЗАТЕЛЬНОЕ_ОГЛАВЛЕНИЕ__', '__ОБЯЗ_ОГЛ__', '__FORCETOC__' ),
	'toc'                       => array( '0', '__СÆРТÆ__', '__ОГЛАВЛЕНИЕ__', '__ОГЛ__', '__TOC__' ),
	'noeditsection'             => array( '0', '__ÆНÆХАЙИВЫНÆЙ__', '__БЕЗ_РЕДАКТИРОВАНИЯ_РАЗДЕЛА__', '__NOEDITSECTION__' ),
	'currentmonth'              => array( '1', 'АЦЫМÆЙ', 'АЦЫМÆЙ2', 'ТЕКУЩИЙ_МЕСЯЦ', 'ТЕКУЩИЙ_МЕСЯЦ_2', 'CURRENTMONTH', 'CURRENTMONTH2' ),
	'currentmonth1'             => array( '1', 'АЦЫМÆЙ1', 'ТЕКУЩИЙ_МЕСЯЦ_1', 'CURRENTMONTH1' ),
	'currentmonthname'          => array( '1', 'АЦЫМÆЙЫНОМ', 'НАЗВАНИЕ_ТЕКУЩЕГО_МЕСЯЦА', 'CURRENTMONTHNAME' ),
	'currentmonthnamegen'       => array( '1', 'АЦЫМÆЙЫНОМГУЫР', 'НАЗВАНИЕ_ТЕКУЩЕГО_МЕСЯЦА_РОД', 'CURRENTMONTHNAMEGEN' ),
	'currentmonthabbrev'        => array( '1', 'АЦЫМÆЙЫНОМЦЫБ', 'НАЗВАНИЕ_ТЕКУЩЕГО_МЕСЯЦА_АБР', 'CURRENTMONTHABBREV' ),
	'currentday'                => array( '1', 'АБОН', 'ТЕКУЩИЙ_ДЕНЬ', 'CURRENTDAY' ),
	'currentday2'               => array( '1', 'АБОН2', 'ТЕКУЩИЙ_ДЕНЬ_2', 'CURRENTDAY2' ),
	'currentdayname'            => array( '1', 'АБОНЫБОНЫНОМ', 'НАЗВАНИЕ_ТЕКУЩЕГО_ДНЯ', 'CURRENTDAYNAME' ),
	'currentyear'               => array( '1', 'АЦЫАЗ', 'ТЕКУЩИЙ_ГОД', 'CURRENTYEAR' ),
	'currenttime'               => array( '1', 'НЫРЫРÆСТÆГ', 'ТЕКУЩЕЕ_ВРЕМЯ', 'CURRENTTIME' ),
	'currenthour'               => array( '1', 'НЫРЫСАХАТ', 'ТЕКУЩИЙ_ЧАС', 'CURRENTHOUR' ),
	'numberofpages'             => array( '1', 'ФÆРСТЫНЫМÆЦ', 'КОЛИЧЕСТВО_СТРАНИЦ', 'NUMBEROFPAGES' ),
	'numberofarticles'          => array( '1', 'УАЦТЫНЫМÆЦ', 'КОЛИЧЕСТВО_СТАТЕЙ', 'NUMBEROFARTICLES' ),
	'pagename'                  => array( '1', 'ФАРСЫНОМ', 'НАЗВАНИЕ_СТРАНИЦЫ', 'PAGENAME' ),
	'img_thumbnail'             => array( '1', 'къаддæргонд', 'къаддæр', 'мини', 'миниатюра', 'thumbnail', 'thumb' ),
	'img_manualthumb'           => array( '1', 'къаддæргонд=$1', 'къаддæр=$1', 'мини=$1', 'миниатюра=$1', 'thumbnail=$1', 'thumb=$1' ),
	'img_right'                 => array( '1', 'рахиз', 'справа', 'right' ),
	'img_left'                  => array( '1', 'галиу', 'слева', 'left' ),
	'img_none'                  => array( '1', 'æнæ', 'без', 'none' ),
	'img_center'                => array( '1', 'астæу', 'центр', 'center', 'centre' ),
);

$linkTrail = '/^((?:[a-z]|а|æ|б|в|г|д|е|ё|ж|з|и|й|к|л|м|н|о|п|р|с|т|у|ф|х|ц|ч|ш|щ|ъ|ы|ь|э|ю|я|“|»)+)(.*)$/sDu';
$fallback8bitEncoding = 'windows-1251';

