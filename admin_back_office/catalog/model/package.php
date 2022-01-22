<?php 
	class PackageModel extends db {
		public function listPackage($data = array()){
			$result = array(
				'result' => 'fail'
			);
			$sql = "SELECT * FROM com_package 
			ORDER by id_package DESC";
			$result_package = $this->query($sql);
			if($result_package->num_rows > 0){
				$result = $result_package->rows;
			}
			return $result;
		}
		public function addPackage($package='',$id_category=0,$discount=0){
			$result = array(
				'result' => 'fail'
			);
			if(!empty($package)){
				$data = array(
					'id_category' 	=> $id_category,
					'name'			=> $package,
					'discount'		=> $discount
				);
				$result_insert = $this->insert('package',$data);
				if($result_insert){
					$result = array(
						'result' => 'success'
					);
				}
			}
			return $result;
		}
		public function delPackage($id_package='',$id_category){
			$result = array(
				'result' => 'fail'
			);
			$sql = 'DELETE FROM b_package WHERE id = '.(int)$id_package;
			$result_del = $this->query($sql);
			if($result_del){
				$result = array(
					'result' => 'success'
				);
			}
			return $result;
		}
		
	}
?>