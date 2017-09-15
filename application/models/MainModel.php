<?php
class MainModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

    public function getAll($type)
    {
		$q = $this->db->query('select * from '.$type);
		return $q->result_array();
    }

	public function getRepetitors($page, $filter = false)
	{
		$num = 5;
		if ($filter){
			$fil = '';
			if ($filter->subject_id){
				$fil .= ' and (r.subject1='.$filter->subject_id.' or r.subject2='.$filter->subject_id.')';
			}
			if ($filter->age_id){
				$fil .=' and rsa.age_id='.$filter->age_id;
			}
			if ($filter->lang_id){
				$fil .= ' and r.lang_id='.$filter->lang_id;
			}
			if ($filter->spec_id){
				$fil .= ' and rss.specialization_id='.$filter->spec_id;
			}
			if ($filter->online){
				$online = date('Y-m-d H:i:s', time()-60*5);
				$fil .= ' and r.visit_at>"'.$online.'"';
			}
			if ($filter->video){
				$fil .= ' and r.link is not null';
			}
			if ($filter->date_from){
				$time_from = $filter->date_from;
			}
			$fil .= ' and rsp.cost>='.$filter->cost_from.' and rsp.cost<='.$filter->cost_to;
			$sel = 'select DISTINCT t.zone_time, r.id, r.avatar, r.lang_id, r.subject1, r.subject2, r.link, r.visit_at, r.first_name, r.about  from repetitors as r, rsa, rsp, rsl, rss, timezones as t where t.id=r.tzone_id and rsa.repetitor_id=r.id and rsl.repetitor_id=r.id and rsp.repetitor_id=r.id and rss.repetitor_id=r.id and r.status=2 '.$fil.' order by  r.reight DESC, r.visit_at DESC limit '.(($page-1)*$num).','.$num;
		} else{
			$sel = 'select DISTINCT t.zone_time, r.id, r.avatar, r.lang_id, r.subject1, r.subject2, r.link, r.visit_at, r.first_name, r.about  from repetitors as r, rsa, rsp, rsl, rss, timezones as t where t.id=r.tzone_id and rsa.repetitor_id=r.id and rsl.repetitor_id=r.id and rsp.repetitor_id=r.id and rss.repetitor_id=r.id and r.status=2 order by r.visit_at DESC, r.reight DESC limit '.(($page-1)*$num).','.$num;
		}


		$q = $this->db->query($sel);
		$repetitors = $q->result_array();
		$temp = array();
		for ($i=0; $i < count($repetitors); $i++) {
			$sel = 'select language from languages where id='.$repetitors[$i]['lang_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['language'] = $r[0]['language'];
			$repetitors[$i]['subjects'] = array();
			for ($k=1; $k <=2 ; $k++) {
				if (!is_null($repetitors[$i]['subject'.$k])){
					$sel = 'select subject from subjects where id='.$repetitors[$i]['subject'.$k];
					$q = $this->db->query($sel);
					$r = $q->result_array();
					$repetitors[$i]['subjects'][] = $r[0]['subject'];
				}
			}
			$sel = 'select DISTINCT s.specialization from specializations as s, rss where rss.specialization_id=s.id and rss.repetitor_id='.$repetitors[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['spec'] = array();
			for ($k=0; $k < count($r) ; $k++) {
				$repetitors[$i]['spec'][] = $r[$k]['specialization'];
			}
			$sel = 'select DISTINCT a.age from ages as a, rsa where rsa.age_id=a.id and rsa.repetitor_id='.$repetitors[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['ages'] = array();
			for ($k=0; $k < count($r) ; $k++) {
				$repetitors[$i]['ages'][] = $r[$k]['age'];
			}
			$sel = 'select DISTINCT cost from rsp where repetitor_id='.$repetitors[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['cost'] = array();
			for ($k=0; $k < count($r) ; $k++) {
				$repetitors[$i]['cost'][] = $r[$k]['cost'];
			}
			if (time() < (strtotime($repetitors[$i]['visit_at']))+60*5){
				$repetitors[$i]['online'] = true;
			} else{
				$repetitors[$i]['online'] = false;
			}
			if($filter){
				$sel = 'select date_from from exercises where date_from>=now() and student_id is null and repetitor_id='.$repetitors[$i]['id'];
				$q = $this->db->query($sel);
				$ex = $q->result_array();
				if($filter->date_from){
					$find = false;
					$date_from = strtotime($filter->date_from)+$filter->utc*60*60;
					$time_from = $date_from + $filter->time_from;
					$time_to = $date_from + $filter->time_from;
					for ($k=0; $k < count($ex) ; $k++) {
						$test = strtotime($ex[$k]['date_from']);
						if ($test >= $time_from && $test <= $time_to){
							$find = true;
						}
					}
					if ($find){
						$temp[] = $repetitors[$i];
					}
				} else{
					$find = false;
					$date_from = strtotime("2017-01-01 00:00:01")+$filter->utc*60*60;

					$time_from = date('G', $date_from + $filter->time_from*60*60);
					$time_to = date('G', $date_from + $filter->time_to*60*60);
					if ($filter->time_from == 0 && $filter->time_to == 24){
						$time_from = 0;
						$time_to = 24;
					}
					for ($k=0; $k < count($ex) ; $k++) {
						$test = substr($ex[$k]['date_from'],11,2);
						if ($time_from<=$time_to){
							if ($test >= $time_from && $test <= $time_to){
								$find = true;
							}
						} else{
							if ($test<=$time_to || $test>=$time_from){
								$find = true;
							}
						}

					}
					if ($find){
						$temp[] = $repetitors[$i];
					}
				}
			}else{
				$temp[] = $repetitors[$i];
			}
		}
		$repetitors = $temp;
		return $repetitors;
	}

	public function repPagg($page, $len=false){
		$num = 5;
		if ($len){
			$all = $len;
		} else{
			$sel = 'select count(id) as c from repetitors';
			$q = $this->db->query($sel);
			$res = $q->result();
			$all = $res[0]->c;
		}
		$pag = array();
		$pages = ceil($all/$num);
		if ($pages <6){
			$pag[] = 1;
			for ($i=1; $i <=$pages ; $i++) {
				$pag[] = $i;
			}
			$pag[] = ($i-1);
		}
		else{
			if ($page<4){
				$pag[]=1;
				$pag[]=1;
				$pag[]=2;
				$pag[]=3;
				$pag[]=4;
				$pag[]=5;
				$pag[]=5;
			} elseif($page == 4){
				$pag[]=2;
				$pag[]=2;
				$pag[]=3;
				$pag[]=4;
				$pag[]=5;
				$pag[]=6;
				$pag[]=6;
			} else{
				$end = $pages - $page;
				echo ' end='.$end.' ';
				if ($end >= 2){
					$pag[] = $page-2;
					$pag[] = $page-2;
					$pag[] = $page-1;
					$pag[] = $page;
					$pag[] = $page+1;
					$pag[] = $page+2;
					$pag[] = $page+2;
				} elseif ($end == 1){
					$pag[] = $page-3;
					$pag[] = $page-3;
					$pag[] = $page-2;
					$pag[] = $page-1;
					$pag[] = $page;
					$pag[] = $page+1;
					$pag[] = $page+1;
				} else{
					$pag[] = $page-4;
					$pag[] = $page-4;
					$pag[] = $page-3;
					$pag[] = $page-2;
					$pag[] = $page-1;
					$pag[] = $page;
					$pag[] = $page;
				}
			}
		}
		$pages = ceil($all/$num);
		return $pag;
	}

	public function getRepetitor($id){
		$q = $this->db->query('select * from repetitors where id='.$id);
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('нет такого id');
		}
		$rep = $r[0];
		$sub = 0;
		for ($i=1; $i <=2 ; $i++) {
			if (!is_null($rep['subject'.$i])){
				$q = $this->db->query('select subject from subjects where id='.$rep['subject'.$i]);
				$r = $q->result_array();
				$rep['sub'.$i.'_name'] = $r['0']['subject'];
				$sub++;
			}
		}
		$rep['sub_num'] = $sub;
		$sel = 'select DISTINCT s.specialization from specializations as s, rss where rss.specialization_id=s.id and rss.repetitor_id='.$id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['spec'] = array();
		for ($k=0; $k < count($r) ; $k++) {
			$rep['spec'][] = $r[$k]['specialization'];
		}
		$sel = 'select DISTINCT a.age from ages as a, rsa where rsa.age_id=a.id and rsa.repetitor_id='.$id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['ages'] = array();
		for ($k=0; $k < count($r) ; $k++) {
			$rep['ages'][] = $r[$k]['age'];
		}
		$sel = 'select DISTINCT cost from rsp where repetitor_id='.$id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['cost'] = array();
		for ($k=0; $k < count($r) ; $k++) {
			$rep['cost'][] = $r[$k]['cost'];
		}
		if (time() < (strtotime($rep['visit_at']))+60*5){
			$rep['online'] = true;
		} else{
			$rep['online'] = false;
		}
		$sel = 'select language from languages where id='.$rep['lang_id'];
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['lang'] = $r[0]['language'];
		$sel = 'select zone_name, zone_time from timezones where id='.$rep['tzone_id'];
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['zone_name'] = $r[0]['zone_name'];
		$rep['zone_time'] = $r[0]['zone_time'];
		return $rep;
	}

	public function getStudent($student_id){
		$q = $this->db->query('select * from students where id='.$student_id);
		$r = $q->result_array();
		$student = $r[0];
		$sel = 'select zone_name, zone_time from timezones where id='.$student['tzone_id'];
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$student['zone_name'] = $r[0]['zone_name'];
		$student['zone_time'] = $r[0]['zone_time'];
		return $student;
	}
}
