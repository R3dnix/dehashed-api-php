<?php
/* DeHashed API Wrapper 2.0 made */
/***********************************************************************************************************************************************/

class DeHashed {

		public $api_url;
		public $api_email;
		public $api_password;
	
		public $parameters_common = array(
			"email", "ip_address", "username", "password", "hashed_password", "name"
		);
		
		public $parameters_result = array(
			"id", "email", "ip_address", "username", "password", "hashed_password", "hash_type", "name", "vin", "phone", "name", "database_name"
		);
		
		public function configure($username, $password, $base_url) {
			$this->api_url = $base_url;
			$this->api_email = $username;
			$this->api_password = $password;
		}
		
		public function getParametersCommon() {
			return $this->parameters_common;
		}
		
		public function sendRequest($query) {
			$url = "https://api.dehashed.com/search?query=" .array_key_first($query). ":" .$query[array_key_first($query)]. "";
			
			$client_id = $this->api_email;
			$client_secret = $this->api_password;
			
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			
			$headers = array(
			   "Accept: application/json",
			   "Authorization: Basic " . base64_encode("$client_id:$client_secret")
			);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			$resp = curl_exec($curl);
			$resp2 = json_decode($resp);
			curl_close($curl);
			var_dump($resp);
		}	
}

$DeHashed = new DeHashed;
$DeHashed->configure("Email", "Api_Key", "https://api.dehashed.com/search");

if($_POST && !empty ($_POST['parameters'])) {
	echo " You are looking for: <b>" .$_POST['parameters']. "</b> which is: <b>" .$_POST["query"]. "</b><br /><br />";
	//echo "<pre>";
	$DeHashed->sendRequest(array($_POST["parameters"] => $_POST["query"]));
	//echo "</pre>";
}
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Auto Website</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
		<style>
			body {
				background-color: #1e1e1e;
				color: snow;
			}
			.advanced {
				text-decoration: none;
				font-size: 15px;
				font-weight: 500
			}
			.btn-secondary,
			.btn-secondary:focus,
			.btn-secondary:active {
				color: #fff;
				background-color: #1e1e1e !important;
				border-color: #1e1e1e !important;
				box-shadow: none
			}
			.advanced {
				color: #1e1e1e !important
			}
			.form-control:focus {
				box-shadow: none;
				border: 1px solid #1e1e1e
			}
			.card {
				color: black;	
			}	
		</style>
	<body>
	<div class="container mt-5">
		<div class="row d-flex justify-content-center">
			<div class="col-md-12">
				<div class="card p-3 py-4">
					<h5>Quick implementation for us just for testing..</h5>
					<div class="row g-3 mt-2">
						<div class="col-md-2">
							<form method="post" action="">
							<div class="form-group">
								<select id="demo_overview_minimal" name="parameters" class="form-control" data-role="select-dropdown" data-profile="minimal">
								<?php
									foreach($DeHashed->getParametersCommon() as $data) { ?>
										<option value="<?php echo $data; ?>"><?php echo $data; ?></option>
								<?php } ?>
								</select>
							</div>
								</div>
								<div class="col-md-9"> <input type="text" name="query" class="form-control" placeholder="Enter email, ip_address, username, password, hashed_password, name, and any other data points.."> </div>
								<div class="col-md-1"> <button type="submit" class="btn btn-secondary btn-block">Give!</button></div>
							</form>
					</div>
					<div class="mt-3">
						<a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="advanced" OnClick="alert('Would be nice huh? ^^ Maybe in future..');"> Advance Search With Filters <i class="fa fa-angle-down"></i> </a>
						<div class="collapse" id="collapseExample">
							<div class="card card-body">
								<div class="row">
									<div class="col-md-4"> <input type="text" placeholder="Property ID" class="form-control"> </div>
									<div class="col-md-4"> <input type="text" class="form-control" placeholder="Search by MAP"> </div>
									<div class="col-md-4"> <input type="text" class="form-control" placeholder="Search by Country"> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
