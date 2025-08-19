<?php 

require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_general'])) 
{
    $q = "SELECT * FROM `settings` WHERE `sr_no` =?";
    $values = [1];
    $res = select($q, $values,"i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['upd_general']))
{
    $frm_data = filteration($_POST);
    
    $q = "UPDATE `settings` SET `site_title`=?,`site_about`=?  WHERE `sr_no`=?";
    $values = [$frm_data['site_title'], $frm_data['site_about'],1];
    $res = update($q,$values,'ssi');
    echo $res;
}


if (isset($_POST['upd_shutdown']))
{
    $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;
    
    $q = "UPDATE `settings` SET `shutdown`=?  WHERE `sr_no`=?";
    $values = [$frm_data,1];
    $res = update($q,$values,'ii');
    echo $res;
}

if (isset($_POST['get_contacts'])) 
{
    $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $res = select($q, $values,"i");
    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);
    echo $json_data;
}

if (isset($_POST['upd_contacts']))
{
    $frm_data = filteration($_POST);
    
    $q ="UPDATE `contact_details` SET `address`=?,`gmap`=?,`pn1`=?,`pn2`=?,`email`=?,`fb`=?,`insta`=?,`tw`=?,`iframe`=? WHERE `sr_no`= ?";
    $values = [$frm_data['address'], $frm_data['gmap'],$frm_data['pn1'],$frm_data['pn2'],$frm_data['email'],$frm_data['fb'],$frm_data['insta'],$frm_data['tw'],$frm_data['iframe'],1];
    $res = update($q,$values,'sssssssssi');
    echo $res;
}

if(isset($_POST['add_member']))
{
    $frm_data = filteration($_POST);
    
    $img_r = uploadImage($_FILES['picture'],ABOUT_FOLDER);

    if($img_r == 'inv_img'){
        echo $img_r;
    }
    else if($img_r == 'inv_size'){
        echo $img_r;
    }
    else if($img_r == 'upd_failed'){
        echo $img_r;
    }
    else {
        $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
        $values = [$frm_data['name'],$img_r];
        $res = insert($q,$values,'ss');
        echo $res;
    }
}

if(isset($_POST['get_members']))
{
    $res = selectAll('team_details');

    while ($row = mysqli_fetch_assoc($res))
    {   
        $path = ABOUT_IMG_PATH;
        echo <<<data
         <div class="col-md-2 mb-3">
            <div class="card bg-dark text-white">
              <img src="$path$row[picture]" class="card-img">
                <div class="card-img-overlay text-end">
                  <button type="button" onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                   <i class="bi bi-trash"></i>Delete
                  </button>
                </div>
              <p class="card-text text-center px-3 py-2">$row[name]</p>
            </div>
         </div>
        data;
    }
}

if(isset($_POST['rem_member'])){
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_member']];

    $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
    $res = select($pre_q,$values,'i');
    $img = mysqli_fetch_assoc($res);

    if(deleteImage($img['picture'],ABOUT_FOLDER)){
        $q = "DELETE FROM `team_details` WHERE `sr_no`= ?";
        $res = delete($q,$values,'i');
        echo $res;
    }
    else{
        echo 0;
    }
}

// Handle Chatbot API Settings Update
if(isset($_POST['update_chatbot_settings'])) {
    $api_key = $_POST['api_key'];
    $model = $_POST['model'];
    $max_tokens = $_POST['max_tokens'];
    $temperature = $_POST['temperature'];
    
    // Update chatbot_config.php file
    $config_path = UPLOAD_IMAGE_PATH.'../inc/chatbot_config.php';
    $config_content = '<?php
// This file contains configuration settings for the chatbot

// OpenAI API Key - Replace with your actual API key
define(\'OPENAI_API_KEY\', \''.$api_key.'\');

// OpenAI Model Configuration
define(\'OPENAI_MODEL\', \''.$model.'\'); // You can upgrade to gpt-4 if needed

// Maximum token count for responses
define(\'MAX_TOKENS\', '.$max_tokens.');

// Temperature setting (0.0 to 1.0) - lower is more deterministic, higher is more creative
define(\'TEMPERATURE\', '.$temperature.');

// Chatbot personality settings
$chatbot_settings = [
    \'name\' => \''.$GLOBALS['chatbot_settings']['name'].'\',
    \'personality\' => \''.$GLOBALS['chatbot_settings']['personality'].'\',
    \'response_style\' => \''.$GLOBALS['chatbot_settings']['response_style'].'\'
];
?>';
    
    if(file_put_contents($config_path, $config_content)) {
        echo 1;
    } else {
        echo 0;
    }
}

// Handle Personality Settings Update
if(isset($_POST['update_personality_settings'])) {
    $name = $_POST['name'];
    $personality = $_POST['personality'];
    $response_style = $_POST['response_style'];
    
    // Update chatbot_config.php file
    $config_path = UPLOAD_IMAGE_PATH.'../inc/chatbot_config.php';
    
    // First read the current file to get other settings
    require(UPLOAD_IMAGE_PATH.'../inc/chatbot_config.php');
    
    $config_content = '<?php
// This file contains configuration settings for the chatbot

// OpenAI API Key - Replace with your actual API key
define(\'OPENAI_API_KEY\', \''.OPENAI_API_KEY.'\');

// OpenAI Model Configuration
define(\'OPENAI_MODEL\', \''.OPENAI_MODEL.'\'); // You can upgrade to gpt-4 if needed

// Maximum token count for responses
define(\'MAX_TOKENS\', '.MAX_TOKENS.');

// Temperature setting (0.0 to 1.0) - lower is more deterministic, higher is more creative
define(\'TEMPERATURE\', '.TEMPERATURE.');

// Chatbot personality settings
$chatbot_settings = [
    \'name\' => \''.$name.'\',
    \'personality\' => \''.$personality.'\',
    \'response_style\' => \''.$response_style.'\'
];
?>';
    
    if(file_put_contents($config_path, $config_content)) {
        echo 1;
    } else {
        echo 0;
    }
}

// Create chat_logs table if it doesn't exist
if(isset($_POST['get_chat_logs'])) {
    // Check if table exists, if not create it
    $table_query = "CREATE TABLE IF NOT EXISTS `chat_logs` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) DEFAULT NULL,
        `user_query` text NOT NULL,
        `bot_response` text NOT NULL,
        `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    )";
    
    if(mysqli_query($con, $table_query)) {
        // Fetch recent chat logs
        $q = "SELECT c.*, u.name as user_name 
              FROM `chat_logs` c
              LEFT JOIN `user_cred` u ON c.user_id = u.id
              ORDER BY c.timestamp DESC LIMIT 20";
        
        $res = mysqli_query($con, $q);
        
        if(mysqli_num_rows($res) == 0) {
            echo '<table class="table table-hover border">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Query</th>
                        <th scope="col">Response</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">No chat logs available</td>
                    </tr>
                </tbody>
            </table>';
        } else {
            $table = '<table class="table table-hover border">
                <thead>
                    <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Query</th>
                        <th scope="col">Response</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>';
            
            $i = 1;
            while($row = mysqli_fetch_assoc($res)) {
                $user_name = $row['user_name'] ? $row['user_name'] : 'Guest';
                
                // Truncate long texts
                $query = strlen($row['user_query']) > 50 ? substr($row['user_query'], 0, 50).'...' : $row['user_query'];
                $response = strlen($row['bot_response']) > 50 ? substr($row['bot_response'], 0, 50).'...' : $row['bot_response'];
                
                $table .= "
                <tr>
                    <td>$i</td>
                    <td>$user_name</td>
                    <td>$query</td>
                    <td>$response</td>
                    <td>".date('d-m-Y H:i:s', strtotime($row['timestamp']))."</td>
                </tr>
                ";
                $i++;
            }
            
            $table .= '</tbody></table>';
            echo $table;
        }
    } else {
        echo 'Error loading chat logs!';
    }
}
?>