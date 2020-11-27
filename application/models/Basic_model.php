<?php



class Basic_model extends CI_Model {

    function __construct() {

    }

    function insertRecord($arr, $tablename) {

        $arr_length = count($arr);

        if ($arr_length > 0) {

            $q = "INSERT INTO `" . $tablename . "`";

            $str_column = "";

            $str_val = "";

            $i = 1;

            foreach ($arr as $key => $value) {

                if ($i == 1) {

                    $str_column.="(";

                    $str_val.=" VALUES(";

                }

                $str_column.="`" . $key . "`,";

                $str_val.=$this->db->escape($value) . ",";

                if ($i == $arr_length) {

                    $str_column = substr($str_column, 0, -1);

                    $str_val = substr($str_val, 0, -1);

                    $str_column.=")";

                    $str_val.=")";

                }

                $i++;

            }

            $q = $q . $str_column . $str_val;



            $resp = $this->db->query($q);
            $id = $this->db->insert_id();

            return $id;

        }

    }



    function updateRecord($arr, $tablename, $column, $val) {
        $arr_length = count($arr);

        if ($arr_length > 0) {
            $q = "UPDATE `" . $tablename . "` SET";
            $str_column = "";
            $i = 1;
            foreach ($arr as $key => $value) {
                $str_column.=" `" . $key . "`=" . "" . $this->db->escape($value) . ",";
                if ($i == $arr_length) {
                    $str_column = substr($str_column, 0, -1);
                    $str_column.=" WHERE `" . $column . "`='" . $val . "'";
                }
                $i++;
            }
            $q = $q . $str_column;
            return $this->db->query($q);
        }

    }



    function getRows($table_name, $column, $criteria, $order = "ASC") {

        $query = "select  * from  `" . $table_name . "` where `" . $column . "`=" . $this->db->escape($criteria) . " ORDER BY `id` " . $order;



        $result = $this->db->query($query);

        return $result->result_array();

    }



    function getMultiData($table_name, $order="ASC") {

        $query = "select  * from  `" . $table_name . "` ";

        $query.=" ORDER BY `id` " . $order;

        $result = $this->db->query($query);

        return $result->result_array();

    }



    function getRow($table_name, $column, $criteria, $order = "ASC") {
      $query = "select  * from  `" . $table_name . "` where `" . $column . "`=" . $this->db->escape($criteria);
      $result = $this->db->query($query);

      if ($result->num_rows() > 0) {
          return $result->row_array();
      }
    }



    function deleteRecord($column, $id, $tablename) {

        $query = "DELETE FROM `" . $tablename . "` WHERE `" . $column . "`=" . $this->db->escape($id) . "";

        $result = $this->db->query($query);

        return $result;

    }
    function ArchiveRecord($column, $id, $tablename) {

        $query = "UPDATE `" . $tablename . "` SET is_archive='1' WHERE `" . $column . "`=" . $this->db->escape($id) . "";

        $result = $this->db->query($query);

        return $result;

    }



    function urlEncrypt2($str) {

        $key = "this is only my website";

        $result = '';

        for ($i = 0; $i < strlen($str); $i++) {

            $char = substr($str, $i, 1);

            $keychar = substr($key, ($i % strlen($key)) - 1, 1);

            $char = chr(ord($char) + ord($keychar));

            $result.=$char;

        }

        return urlencode(base64_encode($result));

    }



    function customeQuery($query) {

        $result = $this->db->query($query);

        return $result;

    }



    function selectSelect($sel_val, $array) {

        $data = "";

        foreach ($array as $key => $value) {

            $active = "";

            if ($sel_val == $key) {

                $active = "selected='selected'";

            }

            $data.="<option value='" . $key . "' " . $active . ">" . $value . "</option>";

        }

        return $data;

    }



    function selectSelect2($sel_val, $array, $name, $id) {

        $data = "";

        foreach ($array as $key => $value) {

            $active = "";

            if ($sel_val == $value[$id]) {

                $active = "selected='selected'";

            }

            $data.="<option value='" . $value[$id] . "' " . $active . ">" . $value[$name] . "</option>";

        }

        return $data;

    }



    public function getCustomRows($query) {

        $result = $this->db->query($query);

        return $result->result_array();

    }



    public function getCustomRow($query) {

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            return $result->row_array();

        }

    }



    public function encode($name) {

        for ($a = 0; $a < 2; $a++) {

            $name = base64_encode($name);



            for ($b = 0; $b < 3; $b++) {

                $name = base64_encode($name);

            }

        }

        return $name;

    }



    function decode($name) {

        for ($a = 0; $a < 2; $a++) {

            $name = base64_decode($name);



            for ($b = 0; $b < 3; $b++) {

                $name = base64_decode($name);

            }

        }

        return $name;

    }



    // function pagination($query, $count_query, $targetpages, $pgs, $orderby, $order) {

    //     // How many adjacent pagess should be shown on each side?

    //     $adjacents = 3;

    //

    //     /*

    //       First get total number of rows in data table.

    //       If you have a WHERE clause in your query, make sure you mirror it here.

    //      */

    //     //$query = "SELECT COUNT(*) FROM $tbl_name";

    //     $total_pages = $this->getCustomRow($count_query);

    //     $total_pages = $total_pages['total'];

    //

    //     /* Setup vars for query. */

    //     if ($pgs == "all") {

    //         $limit = 30000;

    //         $pages = 1;

    //     } else {

    //         $limit = 100;         //how many items to show per pages

    //         $pages = isset($pgs) ? $pgs : 1;

    //     }

    //     if ($pages)

    //         $start = ($pages - 1) * $limit;    //first item to display on this pages

    //     else

    //         $start = 0;        //if no pages var is given, set start to 0

    //

    //         /* Get data. */

    //     $sql = $query . " order by " . $orderby . " " . $order . " LIMIT $start, $limit";

    //     $result = $this->getCustomRows($sql);

    //

    //     /* Setup pages vars for display. */

    //     if ($pages == 0)

    //         $pages = 1;     //if no pages var is given, default to 1.

    //     $prev = $pages - 1;       //previous pages is pages - 1

    //     $next = $pages + 1;       //next pages is pages + 1

    //     $lastpages = ceil($total_pages / $limit);  //lastpages is = total pagess / items per pages, rounded up.

    //     $lpm1 = $lastpages - 1;      //last pages minus 1

    //

    //     /*

    //       Now we apply our rules and draw the pagination object.

    //       We're actually saving the code to a variable in case we want to draw it more than once.

    //      */

    //     $pagination = "";

    //     if ($lastpages > 1) {

    //         $pagination .= "<div class=\"pagination\"><ul>";

    //         //previous button

    //         if ($pages > 1)

    //             $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$prev\">< previous</a></li>";

    //         else

    //             $pagination.= "<li><span class=\"disabled\">< previous</span></li>";

    //

    //         //pagess

    //         if ($lastpages < 7 + ($adjacents * 2)) { //not enough pagess to bother breaking it up

    //             for ($counter = 1; $counter <= $lastpages; $counter++) {

    //                 if ($counter == $pages)

    //                     $pagination.= "<li><span class=\"current\">$counter</span></li>";

    //                 else

    //                     $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$counter\">$counter</a></li>";

    //             }

    //         }

    //         elseif ($lastpages > 5 + ($adjacents * 2)) { //enough pagess to hide some

    //             //close to beginning; only hide later pagess

    //             if ($pages < 1 + ($adjacents * 2)) {

    //                 for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

    //                     if ($counter == $pages)

    //                         $pagination.= "<li><span class=\"current\">$counter</span></li>";

    //                     else

    //                         $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$counter\">$counter</a></li>";

    //                 }

    //                 $pagination.= "...";

    //                 $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$lpm1\">$lpm1</a></li>";

    //                 $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$lastpages\">$lastpages</a></li>";

    //             }

    //             //in middle; hide some front and some back

    //             elseif ($lastpages - ($adjacents * 2) > $pages && $pages > ($adjacents * 2)) {

    //                 $pagination.= "<li><a href=\"&pages=1\">1</a></li>";

    //                 $pagination.= "<li><a href=\"&pages=2\">2</a></li>";

    //                 $pagination.= "...";

    //                 for ($counter = $pages - $adjacents; $counter <= $pages + $adjacents; $counter++) {

    //                     if ($counter == $pages)

    //                         $pagination.= "<li><span class=\"current\">$counter</span></li>";

    //                     else

    //                         $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$counter\">$counter</a></li>";

    //                 }

    //                 $pagination.= "...";

    //                 $pagination.= "<a href=\"" . site_url(array($targetpages)) . "/pages/$lpm1\">$lpm1</a>";

    //                 $pagination.= "<a href=\"" . site_url(array($targetpages)) . "/pages/$lastpages\">$lastpages</a>";

    //             }

    //             //close to end; only hide early pagess

    //             else {

    //                 $pagination.= "<a href=\"" . site_url(array($targetpages)) . "/pages/1\">1</a>";

    //                 $pagination.= "<a href=\"" . site_url(array($targetpages)) . "/pages/2\">2</a>";

    //                 $pagination.= "...";

    //                 for ($counter = $lastpages - (2 + ($adjacents * 2)); $counter <= $lastpages; $counter++) {

    //                     if ($counter == $pages)

    //                         $pagination.= "<li><span class=\"current\">$counter</span></li>";

    //                     else

    //                         $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$counter\">$counter</a></li>";

    //                 }

    //             }

    //         }

    //

    //         //next button

    //         if ($pages < $counter - 1)

    //             $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/$next\">next ></a></li>";

    //         else

    //             $pagination.= "<li><span class=\"disabled\">next ></span></li>";

    //         $pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "/pages/all\">View All</a></li></ul></div>\n";

    //     }

    //     $c = array($pagination, $result);

    //     return $c;

    // }



    function urlEncrypt($str) {

        $key = "abc123 as long as you want bla bla bla";

        $result = '';

        for ($i = 0; $i < strlen($str); $i++) {

            $char = substr($str, $i, 1);

            $keychar = substr($key, ($i % strlen($key)) - 1, 1);

            $char = chr(ord($char) + ord($keychar));

            $result.=$char;

        }

        return urlencode(base64_encode($result));

    }



    function urlDecrypt($str) {

        $str = base64_decode(urldecode($str));

        $result = '';

        $key = "abc123 as long as you want bla bla bla";

        for ($i = 0; $i < strlen($str); $i++) {

            $char = substr($str, $i, 1);

            $keychar = substr($key, ($i % strlen($key)) - 1, 1);

            $char = chr(ord($char) - ord($keychar));

            $result.=$char;

        }

        return $result;

    }



    function urlDecrypt2($str) {

        $str = base64_decode(urldecode($str));

        $result = '';

        $key = "this is only my website";

        for ($i = 0; $i < strlen($str); $i++) {

            $char = substr($str, $i, 1);

            $keychar = substr($key, ($i % strlen($key)) - 1, 1);

            $char = chr(ord($char) - ord($keychar));

            $result.=$char;

        }

        return $result;

    }



    function sendEmail($from, $to, $body, $subject) {

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: ' . $from . ' <' . $from . '>' . "\r\n";

        $res = mail($to, $subject, $body, $headers);

        return $res;

    }



    function multiSearch($array, $key, $value) {

        $results = array();



        if (is_array($array)) {

            if (isset($array[$key]) && $array[$key] == $value)

                $results[] = $array;



            foreach ($array as $subarray)

                $results = array_merge($results, $this->multiSearch($subarray, $key, $value));

        }



        return $results;

    }



    function multiSelect2($sel_val, $array, $name, $id, $findname) {

        $data = "";

        foreach ($array as $key => $value) {

            $active = "";

            $res = $this->multiSearch($sel_val, $findname, $value[$id]);

            if (count($res) > 0) {

                $active = "selected='selected'";

            }

            $data.="<option value='" . $value[$id] . "' " . $active . ">" . $value[$name] . "</option>";

        }

        return $data;

    }



    function create_breadcrumb() {

        $ci = &get_instance();

        $i = 1;

        $uri = $ci->uri->segment($i);

        $link = '<ul>';



        while ($uri != '') {

            $prep_link = '';

            for ($j = 1; $j <= $i; $j++) {

                $prep_link .= $ci->uri->segment($j) . '/';

            }



            if ($ci->uri->segment($i + 1) == '') {

                $link.='<li>»<a href="' . site_url($prep_link) . '"><b>';

                $link.=$ci->uri->segment($i) . '</b></a></li> ';

            } else {

                $link.='<li>» <a href="' . site_url($prep_link) . '">';

                $link.=$ci->uri->segment($i) . '</a></li> ';

            }



            $i++;

            $uri = $ci->uri->segment($i);

        }

        $link .= '</ul>';

        return $link;

    }



    function convertIndexToID($array, $id) {

        $new = array();

        foreach ($array as $key => $value) {

            $new[$value[$id]] = $value;

        }

        return $new;

    }



    function uploadFile($file, $uploads_dir) {

        set_time_limit(0);

        if ($file['size'] > 0) {

            $pic_name = "";

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            $pic_name = rand();

            $tmp_name = $file["tmp_name"];

            $pic_name.= $file["name"];

            move_uploaded_file($tmp_name, "$uploads_dir/$pic_name");


            return $pic_name;

        } else {

            return "";

        }

    }



    function nicetime($date) {

        if (empty($date)) {

            return "No date provided";

        }



        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");



        $now = time();

        $unix_date = strtotime($date);



// check validity of date

        if (empty($unix_date)) {

            return "Bad date";

        }



// is it future date or past date

        if ($now > $unix_date) {

            $difference = $now - $unix_date;

            $tense = "ago";

        } else {

            $difference = $unix_date - $now;

            $tense = "from now";

        }



        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {

            $difference /= $lengths[$j];

        }



        $difference = round($difference);



        if ($difference != 1) {

            $periods[$j].= "s";

        }



        return "$difference $periods[$j] {$tense}";

    }



    function urlFriendly($data) {

        $data = trim($data);

        $data = str_replace(" ", "-", $data);

        $data = str_replace("/", "+", $data);

        return $data;

    }



    function urlFriendlyToOriginal($data) {

        $data = str_replace("-", " ", $data);

        $data = str_replace("+", "/", $data);

        return $data;

    }



    function url($url) {

        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);

        $url = trim($url, "-");

        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);

        $url = strtolower($url);

        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

        return $url;

    }



    function convert_number_to_words($number) {

        $nums=explode(".", $number);



        if((@$nums[1])==0)

        {

            $number=$nums[0];

        }



        $hyphen = '-';

        $conjunction = ' and ';

        $separator = ', ';

        $negative = 'negative ';

        $decimal = '  rials and ';

        $dictionary = array(

            0 => '',

            1 => 'one',

            2 => 'two',

            3 => 'three',

            4 => 'four',

            5 => 'five',

            6 => 'six',

            7 => 'seven',

            8 => 'eight',

            9 => 'nine',

            10 => 'ten',

            11 => 'eleven',

            12 => 'twelve',

            13 => 'thirteen',

            14 => 'fourteen',

            15 => 'fifteen',

            16 => 'sixteen',

            17 => 'seventeen',

            18 => 'eighteen',

            19 => 'nineteen',

            20 => 'twenty',

            30 => 'thirty',

            40 => 'fourty',

            50 => 'fifty',

            60 => 'sixty',

            70 => 'seventy',

            80 => 'eighty',

            90 => 'ninety',

            100 => 'hundred',

            1000 => 'thousand',

            1000000 => 'million',

            1000000000 => 'billion',

            1000000000000 => 'trillion',

            1000000000000000 => 'quadrillion',

            1000000000000000000 => 'quintillion'

        );



        if (!is_numeric($number)) {

            return false;

        }



        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

            // overflow

            trigger_error(

                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING

            );

            return false;

        }



        if ($number < 0) {

            return $negative . $this->convert_number_to_words(abs($number));

        }



        $string = $fraction = null;



        if (strpos($number, '.') !== false) {

            list($number, $fraction) = explode('.', $number);

        }



        switch (true) {

            case $number < 21:

                $string = $dictionary[$number];

                break;

            case $number < 100:

                $tens = ((int) ($number / 10)) * 10;

                $units = $number % 10;

                $string = $dictionary[$tens];

                if ($units) {

                    $string .= $hyphen . $dictionary[$units];

                }

                break;

            case $number < 1000:

                $hundreds = $number / 100;

                $remainder = $number % 100;

                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

                if ($remainder) {

                    $string .= $conjunction . $this->convert_number_to_words($remainder);

                }

                break;

            default:

                $baseUnit = pow(1000, floor(log($number, 1000)));

                $numBaseUnits = (int) ($number / $baseUnit);

                $remainder = $number % $baseUnit;

                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];

                if ($remainder) {

                    $string .= $remainder < 100 ? $conjunction : $separator;

                    $string .= $this->convert_number_to_words($remainder);

                }

                break;

        }



        if (null !== $fraction && is_numeric($fraction)) {

            if($string!="")

            {

                $string .= $decimal;

            }

            $words = array();

            foreach (str_split((string) $fraction) as $number) {

                $words[] = $dictionary[$number];

            }

            $string .= implode(' ', $words);

            $string .=" baisa";

        }

        if(!strstr($string, "ONLY"))

        {

            $string.=" ONLY";

        }

        return strtoupper($string);

    }

    function submitForm($form_action, $post_params) {

//        $this->proxy = $this->getProxy();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

//        curl_setopt($ch, CURLOPT_PROXY, $this->proxy);

        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_URL, $form_action);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);

        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        $loggedin = curl_exec($ch);

        curl_close($ch);

        return $loggedin;

    }

    function printurlGenerator()

    {

        $url=$_SERVER['REQUEST_URI'];

        if(strstr($url, "?"))

        {

            $url.="&";

        }

        else

        {

            $url.="?";

        }

        if(!strstr($url, "print"))

        {

            $url.="rtype=print";

        }

        return $url;

    }



    function is_login($obj) {

        $admin_logged_in = $obj->session->userdata('admin_logged_in');

        if (!$admin_logged_in) {

            redirect("users");

            return;

        } else {

            $user_id = $obj->session->userdata('user_id');

            return $user_id;

        }

    }

    function update_with_multiple_conditions($to_update, $table_name, $where_cond_array) {

        if(!$to_update || !$table_name || !$where_cond_array) {

            return false;

            die();

        }



        $arr_length = count($to_update);

        if ($arr_length > 0) {

            $q = "UPDATE `" . $table_name . "` SET";

            $str_column = "";

            $i = 1;

            foreach ($to_update as $key => $value) {

                $str_column.=" `" . $key . "`=" . "" . $this->db->escape($value) . ",";

                if ($i == $arr_length) {

                    $str_column = substr($str_column, 0, -1);

                }

                $i++;

            }

            $count = 0;

            $arr_length1 = count($where_cond_array);

            if ($arr_length1 > 0) {

                foreach ($where_cond_array as $key => $value) {

                    if($count > 0) {

                        $str_column.=" AND ";

                    }

                    if($count == 0) {

                        $str_column.=" WHERE ";

                    }

                    $str_column.="`" . $key . "`='" . $value . "'";

                    $count++;

                }

            }



            $q = $q . $str_column;



            $this->db->query($q);

        }

    }



    function run($query){

        $res = $this->db->query($query);

        return $res;

    }



    function approval_get_levl($voucher_id,$dep_name) {



        // removing

        // $user_id = $this->session->userdata('id');



        // $query = 'SELECT voucher_approvals.*,voucher_approvals_forms.priority_level

        //         FROM `voucher_approvals`

        //         LEFT JOIN voucher_approvals_forms

        //         ON voucher_approvals.user_id = voucher_approvals_forms.user_id AND voucher_approvals.form_name = voucher_approvals_forms.form_name

        //         WHERE voucher_approvals.form_name = \''.$dep_name.'\' AND voucher_approvals.voucher_id = '.$voucher_id.'

        //         AND voucher_approvals.user_id = '.$user_id.'  AND voucher_approvals_forms.priority_level = 1';





        $query = 'SELECT voucher_approvals.*,voucher_approvals_forms.priority_level

                FROM `voucher_approvals`

                LEFT JOIN voucher_approvals_forms

                ON voucher_approvals.user_id = voucher_approvals_forms.user_id AND voucher_approvals.form_name = voucher_approvals_forms.form_name

                WHERE voucher_approvals.form_name = \''.$dep_name.'\' AND voucher_approvals.voucher_id = '.$voucher_id.'

                AND voucher_approvals_forms.priority_level = 1';



        $result = $this->db->query($query);

        return $result->result_array();

    }



    function pagination($query, $count_query, $targetpages, $pgs, $orderby, $order, $limit = 10) {

        // How many adjacent pagess should be shown on each side?

        $adjacents = 3;



        /*

          First get total number of rows in data table.

          If you have a WHERE clause in your query, make sure you mirror it here.

         */

        //$query = "SELECT COUNT(*) FROM $tbl_name";

        $total_pages = $this->getCustomRow($count_query);



        $total_pages = $total_pages['total'];



        /* Setup vars for query. */

        if ($pgs == "all") {

            $limit = 30000;

            $pages = 1;

        } else {

            //$limit = 100;         //how many items to show per pages

            $pages = isset($pgs) ? $pgs : 1;

        }

        if ($pages)

            $start = ($pages - 1) * $limit;    //first item to display on this pages

        else

            $start = 0;        //if no pages var is given, set start to 0



            /* Get data. */

        $sql = $query . " order by " . $orderby . " " . $order . " LIMIT $start, $limit";

        $result = $this->getCustomRows($sql);



        /* Setup pages vars for display. */

        if ($pages == 0)

            $pages = 1;     //if no pages var is given, default to 1.

        $prev = $pages - 1;       //previous pages is pages - 1

        $next = $pages + 1;       //next pages is pages + 1

        $lastpages = ceil($total_pages / $limit);  //lastpages is = total pagess / items per pages, rounded up.

        $lpm1 = $lastpages - 1;      //last pages minus 1



        /*

          Now we apply our rules and draw the pagination object.

          We're actually saving the code to a variable in case we want to draw it more than once.

         */

        $pagination = "";

        if ($lastpages > 1) {

            $pagination .= "<ul class=\"pagination\">";

            //previous button

            if ($pages > 1)

                $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$prev\"><i class=\"fa fa-chevron-left\"></i></a></li>";

            else

                $pagination .= "<li><span class=\"disabled\"><i class=\"fa fa-chevron-left\"></i></span></li>";



            //pagess

            if ($lastpages < 7 + ($adjacents * 2)) { //not enough pagess to bother breaking it up

                for ($counter = 1; $counter <= $lastpages; $counter++) {

                    if ($counter == $pages)

                        $pagination .= "<li><span class=\"active-page\">$counter</span></li>";

                    else

                        $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$counter\">$counter</a></li>";

                }

            }

            elseif ($lastpages > 5 + ($adjacents * 2)) { //enough pagess to hide some

                //close to beginning; only hide later pagess

                if ($pages < 1 + ($adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {

                        if ($counter == $pages)

                            $pagination .= "<li><span class=\"active-page\">$counter</span></li>";

                        else

                            $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$counter\">$counter</a></li>";

                    }

                    $pagination .= "<li><a>...</a></li>";

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$lpm1\">$lpm1</a></li>";

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$lastpages\">$lastpages</a></li>";

                }

                //in middle; hide some front and some back

                elseif ($lastpages - ($adjacents * 2) > $pages && $pages > ($adjacents * 2)) {

                    $pagination .= "<li><a href=\"&pages=1\">1</a></li>";

                    $pagination .= "<li><a href=\"&pages=2\">2</a></li>";

                    $pagination .= "<li><a>...</a></li>";

                    for ($counter = $pages - $adjacents; $counter <= $pages + $adjacents; $counter++) {

                        if ($counter == $pages)

                            $pagination .= "<li><span class=\"active-page\">$counter</span></li>";

                        else

                            $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$counter\">$counter</a></li>";

                    }

                    $pagination .= "<li><a>...</a></li>";

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$lpm1\">$lpm1</a></li>";

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$lastpages\">$lastpages</a></li>";

                }

                //close to end; only hide early pagess

                else {

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=1\">1</a></li>";

                    $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=2\">2</a></li>";

                    $pagination .= "<li><a>...</a></li>";

                    for ($counter = $lastpages - (2 + ($adjacents * 2)); $counter <= $lastpages; $counter++) {

                        if ($counter == $pages)

                            $pagination .= "<li><span class=\"active-page\">$counter</span></li>";

                        else

                            $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$counter\">$counter</a></li>";

                    }

                }

            }



            //next button

            if ($pages < $counter - 1)

                $pagination .= "<li><a href=\"" . site_url(array($targetpages)) . "pages=$next\"><i class=\"fa fa-chevron-right\"></i></a></li>";

            else

                $pagination .= "<li><span class=\"disabled\"><i class=\"fa fa-chevron-right\"></i></span></li>";

            //$pagination.= "<li><a href=\"" . site_url(array($targetpages)) . "pages=all\">View All</a></li></ul>\n";

            $pagination .= "</ul>\n";

        }

        $c = array($pagination, $result);

        return $c;

    }

    function getRows2($tbl,$column,$id){
        $this->db->where($column,$id);
        return $this->db->get($tbl)->result_array();
    }

    public function insertMultiple($multiple_arr, $tbl_name) {
      $resp = $this->db->insert_batch($tbl_name, $multiple_arr);
      return $resp;
    }

    public function updateData($table, $data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update("$table", $data);
        return true;
    }

    // new
    public function get_graphs($oder_status,$user_id='',$start_data='',$end_data='',$year='') {
        if ($oder_status == 'incoming') {
            $this->db->select('SUM(orders_more.qty) as qty');
        }else{
            $this->db->select('SUM(orders_more.good_qty+orders_more.bad_qty) as qty');
        }
        $this->db->from('orders');
        $this->db->join('orders_more','orders_more.order_id = orders.id');
        if ($oder_status == 'inventory') {
            $this->db->where('orders.status = "received"');
        }else{
            $this->db->where('orders.status',$oder_status);
        }if (!empty($start_data) && !empty($end_data)) {
            if ($start_data != 'all') {
                $this->db->where('orders.date_added >=', $start_data);
                $this->db->where('orders.date_added <=', $end_data);
            }
        }
        if ($user_id != '') {
            $this->db->where('orders.user_id',$user_id);
        }
        $query = $this->db->get();
        $result = $query->row();

        // if($oder_status == 'inventory') {
        //   echo $this->db->last_query();
        //   die();
        // }
        return $result;
    }

    public function getShippedItemsTotal($start_data, $end_data) {
      $this->db->select('SUM(orders_more.qty) as qty');
      $this->db->select('SUM(orders_more.good_qty+orders_more.bad_qty) as qty');
      $this->db->from('user_orders');
      $this->db->join('user_orderdetails','user_orderdetails.user_orderid = user_orders.id');
      $this->db->join('orders_more','orders_more.order_id = user_orderdetails.order_id');
      $this->db->where('user_orders.status = "completed"');

      if (!empty($start_data) && !empty($end_data)) {
          if ($start_data != 'all') {
              $this->db->where('user_orders.datetime >=', $start_data);
              $this->db->where('user_orders.datetime <=', $end_data);
          }
      }
      return $this->db->get()->row();
    }
    public function get_users_graphs($status)
    {
        $this->db->select('COUNT(id) as qty');
        $this->db->from('users');
        $this->db->where('users.user_status',$status);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    public function get_orders_graphs($status,$user_id='')
    {
        if ($user_id!=''){
            $queryt= " SELECT COUNT(id) AS qty  FROM user_orders
            WHERE STATUS ='new' AND DATETIME > DATE_SUB(NOW(),INTERVAL 15 DAY) AND user_id =".$user_id;
             }
             else{
                $queryt= " SELECT COUNT(id) AS qty  FROM user_orders
                WHERE STATUS ='new' AND DATETIME > DATE_SUB(NOW(),INTERVAL 15 DAY) ";
            }

        // $this->db->select('COUNT(id) as qty');
        // $this->db->from('user_orders');
        // $this->db->where('user_orders.status',$status);
        // if ($user_id!=''){
        //   $this->db->where('user_orders.user_id',$user_id);
        // }
        // $query = $this->db->get();

        $query=$this->db->query($queryt);
        $result = $query->row();
        return $result;
    }

    public function get_inv_graphs($status,$user_id='')
    {
        $queryt= " SELECT COUNT(id) AS qty  FROM orders
        WHERE STATUS ='incoming'  AND user_id =".$user_id;

        $query=$this->db->query($queryt);
        $result = $query->row();
        return $result;

    }

    public function get_users_size($status,$user_id='')
    {

        $this->db->select('orders_more.*');
        $this->db->from('orders_more');
        $this->db->join('orders','orders_more.order_id = orders.id');

        if($status == "size_user"){
            $this->db->where('orders.user_id',$user_id);
        }

        $this->db->where('orders.status','received');

        $query = $this->db->get()->result();

        // $query1="SELECT length FROM orders_more";
        // $query2=$this->db->query($query1);
        // $df=$query2->first();

        $qty=0;


        foreach($query as $countsize){
            $width1=$countsize->width;
            $length=$countsize->length;
            $height=$countsize->height;

            if($length == 0)
            { $length = 1;}
                if($width1 == 0){$width1 = 1;}
                if($height == 0){$height = 1;}
                $p=$length*$width1*$height;
                $ans1=($p)/1728;
                $ans=round($ans1, 3);
                $qty+=$ans*($countsize->good_qty + $countsize->bad_qty);
        }
        return $qty;

    }
    public function get_pastdueorders_graphs($status,$user_id='',$date)
    {
         if ($user_id!=''){
        $queryt= " SELECT COUNT(id) AS qty  FROM user_orders
        WHERE STATUS ='new' AND DATETIME <= DATE_SUB(NOW(),INTERVAL 3 DAY) AND user_id =".$user_id;
         }
         else{
            $queryt= " SELECT COUNT(id) AS qty  FROM user_orders
            WHERE STATUS ='new' AND DATETIME <= DATE_SUB(NOW(),INTERVAL 3 DAY) ";
        }
        $query=$this->db->query($queryt);
        $result = $query->row();

        return $result;

        // $this->db->select('COUNT(id) as qty');
        // $this->db->from('user_orders');
        // $this->db->where('user_orders.status','completed');
        // $this->db->where('DATE_FORMAT(user_orders.datetime,"%Y-%m-%d") <=',$date);
        //
        // if ($user_id!=''){
        //   $this->db->where('user_orders.user_id',$user_id);
        // }
        //
        // $query = $this->db->get()->row();
        //
        // return $query;

    }


    public function get_order_data($id)
    {
        $this->db->select('orders.*, users.username as customer_name');
        $this->db->from('orders');
        $this->db->join('users','orders.user_id = users.id');
        $this->db->where('orders.id',$id);
        $this->db->where('orders.is_deleted',0);
        $query = $this->db->get();
        return $query->row();
    }

    public function getOneCol($table,$col,$id)
    {
        $this->db->where("$col",$id);
        $this->db->limit('1');
        $this->db->order_by('id','desc');
        $query = $this->db->get("$table");
        return $query->row();
    }

    public function insertDataReturnLastId($table, $data)
    {
        $this->db->insert("$table", $data);
        return $this->db->insert_id();
    }

        // Insert Data from Any Table;
    public function insert_alltable($table_name,$data)
    {
        return $this->db->insert("$table_name", $data);
    }

    public function change_user_status($start_data,$end_data)
    {
        $this->db->where('orders.date_added >=', $start_data);
        $this->db->where('orders.date_added <=', $end_data);
        $query = $this->db->get("orders");
        $result = $query->result();
        return $result;
    }

    // Random number function
    public function getrandomno($n) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function insert($arr, $tbl_name) {
      $this->db->insert($tbl_name, $arr);
      return $this->db->insert_id();
    }
}



?>
