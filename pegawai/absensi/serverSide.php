<?php
	/**
		* Script:    DataTables server-side script for PHP 5.2+ and MySQL 4.1+
		* Notes:     Based on a script by Allan Jardine that used the old PHP mysql_* functions.
		*            Rewritten to use the newer object oriented mysqli extension.
		* Copyright: 2010 - Allan Jardine (original script)
		*            2012 - Kari Söderholm, aka Haprog (updates)
		* License:   GPL v2 or BSD (3-point)
	*/
	mb_internal_encoding('UTF-8');

	//route
	include_once("../../route.php");

	/**
		* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
	*/
	$aColumns = array('id_absen','hari', 'tgl'); //Kolom Pada Tabel

	// Indexed column (used for fast and accurate table cardinality)
	$sIndexColumn = 'id_absen';

	// DB table to use
	$sTable = 'absensi'; // Nama Tabel

	// Database connection information
	include_once("$docs/database/db-connection.php");

	// Input method (use $_GET, $_POST or $_REQUEST)
	$input =& $_POST;

	$gaSql['charset']  = 'utf8';

	/**
		* MySQL connection
	*/
	$db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
	if (mysqli_connect_error()) {
		die( 'Error connecting to MySQL server (' . mysqli_connect_errno() .') '. mysqli_connect_error() );
	}

	if (!$db->set_charset($gaSql['charset'])) {
		die( 'Error loading character set "'.$gaSql['charset'].'": '.$db->error );
	}


	/**
		* Paging
	*/
	$sLimit = "";
	if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
		$sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );
	}


	/**
		* Ordering
	*/
	$aOrderingRules = array();
	if ( isset( $input['iSortCol_0'] ) ) {
		$iSortingCols = intval( $input['iSortingCols'] );
		for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
			if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
				$aOrderingRules[] =
                "`".$aColumns[ intval( $input['iSortCol_'.$i] ) ]."` "
                .($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');
			}
		}
	}

	if (!empty($aOrderingRules)) {
		$sOrder = " GROUP BY tgl ORDER BY ".implode(", ", $aOrderingRules);
		} else {
		$sOrder = " GROUP BY tgl ";
	}


	/**
		* Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
	*/
	$iColumnCount = count($aColumns);

	if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {
		$aFilteringRules = array();
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {
				$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string( $input['sSearch'] )."%'";
			}
		}
		if (!empty($aFilteringRules)) {
			$aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
		}
	}

	// Individual column filtering
	for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
		if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
			$aFilteringRules[] = "`".$aColumns[$i]."` LIKE '%".$db->real_escape_string($input['sSearch_'.$i])."%'";
		}
	}

	if (!empty($aFilteringRules)) {
		$sWhere = " WHERE ".implode(" AND ", $aFilteringRules);
		} else {
		$sWhere = "";
	}


	/**
		* SQL queries
		* Get data to display
	*/
	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}

	$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `".implode("`, `", $aQueryColumns)."`
    FROM `".$sTable."`".$sWhere.$sOrder.$sLimit;

	$rResult = $db->query( $sQuery ) or die($db->error);

	// Data set length after filtering
	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = $db->query( $sQuery ) or die($db->error);
	list($iFilteredTotal) = $rResultFilterTotal->fetch_row();

	include_once("$docs/database/koneksi.php");
	// Total data set length
	$sQuery = "SELECT COUNT(`".$sIndexColumn."`) FROM `".$sTable."` GROUP BY tgl";
	$rResultTotal = $db->prepare( $sQuery );
	$rResultTotal->execute();
	list($iTotal) = array($rResultTotal->rowCount());


	/**
		* Output
	*/
	$output = array(
    "sEcho"                => intval($input['sEcho']),
    "iTotalRecords"        => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData"               => array(),
	);

	// Looping Data
	$no = 1; //numbering
  	include_once("$docs/function.php");

	while ( $aRow = $rResult->fetch_assoc() ) {
		$row = array();
		for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
			$row[] = $aRow[ $aColumns[$i] ];
		}

		$btn = "<center>
					<a href='$host/pegawai/absensi/?a=absensi&tgl=$aRow[tgl]' class='btn btn-info btn-sm' title='Lihat Detail'><i class='fa fa-eye'></i></a>
	                <a href='javascript:void(0)' class='btn btn-danger btn-sm' onclick='del_absen_tgl(\"".$aRow['tgl']."\",\"".indo_date($aRow['tgl'])."\")' title='Delete'><i class='fa fa-trash-o'></i></a>
	            </center>";
		$row = array( $no, hari($aRow['tgl']), indo_date($aRow['tgl']), $btn );
		$output['aaData'][] = $row;
		$no++;
	}
	//tutup koneksi db
	$db = 0;

	echo json_encode( $output );

?>