<?php
	class Kpi extends AppModel{
		var $name='Kpi';
		var $useTable=false;


    function getkpi($date = null,$status = null){
      $kpie = $this->query("SELECT * FROM sp_driver_kpi('".$date."','".$status."')");
      //print_r("SELECT * FROM sp_driver_kpi('".$date."','".$status."')");
      return $kpie;
    }

    function countkpi($date = null,$status = null){
      $kpie = $this->query("SELECT count(*) FROM sp_driver_kpi('".$date."','".$status."')");
      return $kpie;
    }

		function kpinow($state = null,$is_test = null, $radiotaxi_id = null){
			$radiotaxi_id = empty($radiotaxi_id) ? 0 : $radiotaxi_id; 
			$kpi = $this->query("SELECT * FROM sp_driver_kpi_now('".$state."',".$is_test.",".$radiotaxi_id.")");
			return $kpi;
		}

		function getOrders($dateFrom,$dateTo){
			$orders = $this->query("SELECT * FROM sp_get_orders('".$this->formatDate($dateFrom)."','".$this->formatDate($dateTo)."')");
			return $orders;
		}
}
?>
