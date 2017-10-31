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
				$fil .= ' and activity=1 and r.visit_at>"'.$online.'"';
			}
			if ($filter->video){
				$fil .= ' and r.link is not null and not link=""';
			}
			if ($filter->date_from){
				$time_from = $filter->date_from;
			}
			$fil .= ' and rsp.cost>='.($filter->cost_from*1.3).' and rsp.cost<='.($filter->cost_to*1.3);

		} else{
			//$time_from = date('Y-m-d H:i:s', time();
			$fil ='';
		}
		$sel = 'select DISTINCT r.reight, r.activity, t.zone_time, r.id, r.avatar, r.lang_id, r.subject1, r.subject2, r.link, r.visit_at, r.first_name, r.about, r.father_name  from repetitors as r, rsa, rsp, rsl, rss, timezones as t where t.id=r.tzone_id and rsa.repetitor_id=r.id and rsl.repetitor_id=r.id and rsp.repetitor_id=r.id and rss.repetitor_id=r.id and r.status=2 '.$fil.' order by  r.reight DESC, r.visit_at DESC limit '.(($page-1)*$num).','.$num;
		$q = $this->db->query($sel);
		$temp = $q->result_array();
		$repetitors = array();
		$i = 0;
		foreach ($temp as $t) {
			$find = true;
			if ($filter){
				if ($filter->subject_id){
					if ($filter->subject_id !=$t['subject1']){
						$find = false;
					}
				}
			}
			//$find = true;
			if ($find){
				$repetitors[$i] = array(
					'activity'=>$t['activity'],
					'zone_time'=>$t['zone_time'],
					'id'=>$t['id'],
					'avatar'=>$t['avatar'],
					'lang_id'=>$t['lang_id'],
					'subject_id'=>$t['subject1'],
					'link'=>$t['link'],
					'visit_at'=>$t['visit_at'],
					'first_name'=>$t['first_name'],
					'about'=>$t['about'],
					'father_name'=>$t['father_name'],
					'reight'=>$t['reight'],
				);
				$i++;
			}
			$find = true;
			if ($filter){
				if ($filter->subject_id){
					if ($filter->subject_id !=$t['subject2']){
						$find = false;
					}
				}
			}
			//$find = true;
			if (!is_null($t['subject2']) && $find){
				$repetitors[$i] = array(
					'activity'=>$t['activity'],
					'zone_time'=>$t['zone_time'],
					'id'=>$t['id'],
					'avatar'=>$t['avatar'],
					'lang_id'=>$t['lang_id'],
					'subject_id'=>$t['subject2'],
					'link'=>$t['link'],
					'visit_at'=>$t['visit_at'],
					'first_name'=>$t['first_name'],
					'about'=>$t['about'],
					'father_name'=>$t['father_name'],
					'reight'=>$t['reight'],
				);
				$i++;
			}
		}
		$temp = array();
		for ($i=0; $i < count($repetitors); $i++) {
			$sel = 'select language from languages where id='.$repetitors[$i]['lang_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['language'] = $r[0]['language'];
			$sel = 'select subject from subjects where id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['subject'] = $r[0]['subject'];
			$sel = 'select DISTINCT s.specialization from specializations as s, rss where rss.specialization_id=s.id and rss.repetitor_id='.$repetitors[$i]['id'].' and rss.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['spec'] = array();
			foreach ($r as $k) {
				$repetitors[$i]['spec'][] = $k['specialization'];
			}
			$sel = 'select DISTINCT a.age from ages as a, rsa where rsa.age_id=a.id and rsa.repetitor_id='.$repetitors[$i]['id'].' and rsa.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['ages'] = array();
			foreach ($r as $k) {
				$repetitors[$i]['ages'][] = $k['age'];
			}
			$sel = 'select DISTINCT cost from rsp where repetitor_id='.$repetitors[$i]['id'].' and rsp.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['cost'] = round($r[0]['cost']*1.3);
			if ( (time() < (strtotime($repetitors[$i]['visit_at'])+60*5)) && ($repetitors[$i]['activity'] >0)){
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
					$time_to = $date_from + $filter->time_to;
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

	public function repPagg2($page, $num, $all){
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

	public function getRepetitor($id, $subject_id = 0){
		$q = $this->db->query('select * from repetitors where id='.$id);
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('нет такого id');
		}
		// if ($r[0]['status'] != 2){
		// 	throw new Exception('репетитор заблокирован');
		// }
		$rep = $r[0];
		if ($subject_id == 0){
			$subject_id = $rep['subject1'];
		}
		$rep['subject_id'] = $subject_id;
		$q = $this->db->query('select subject from subjects where id='.$subject_id);
		$r = $q->result_array();
		$rep['subject'] = $r['0']['subject'];
		$sel = 'select DISTINCT s.specialization from specializations as s, rss where rss.specialization_id=s.id and rss.repetitor_id='.$id.' and rss.subject_id='.$subject_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['spec'] = array();
		for ($k=0; $k < count($r) ; $k++) {
			$rep['spec'][] = $r[$k]['specialization'];
		}
		$sel = 'select DISTINCT a.age from ages as a, rsa where rsa.age_id=a.id and rsa.repetitor_id='.$id.' and rsa.subject_id='.$subject_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$rep['ages'] = array();
		for ($k=0; $k < count($r) ; $k++) {
			$rep['ages'][] = $r[$k]['age'];
		}
		$sel = 'select DISTINCT cost from rsp where repetitor_id='.$id.' and subject_id='.$subject_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			$rep['cost'] = 0;
		} else{
			$rep['cost'] = $r[0]['cost']*1.3;
		}
		if ( (time() < (strtotime($rep['visit_at'])+60*5)) && ($rep['activity'] >0)){
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
		if (!is_null($rep['avatar'])){
			$filename = 'images/'.$rep['avatar'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('avatar' => NULL));
				$rep['avatar'] = NULL;
			}
		}
		if (!is_null($rep['doc1'])){
			$filename = 'images/'.$rep['doc1'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('doc1' => NULL));
				$rep['doc1'] = NULL;
			}
		}
		if (!is_null($rep['doc2'])){
			$filename = 'images/'.$rep['doc2'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('doc2' => NULL));
				$rep['doc2'] = NULL;
			}
		}
		return $rep;
	}

	public function getStudent($student_id){
		$q = $this->db->query('select * from students where id='.$student_id);
		$r = $q->result_array();
		$student = $r[0];
		if (is_null($student['tzone_id'])){
			$student['zone_name'] = 'не выбрано';
			$student['zone_time'] = 0;
		} else{
			$sel = 'select zone_name, zone_time from timezones where id='.$student['tzone_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$student['zone_name'] = $r[0]['zone_name'];
			$student['zone_time'] = $r[0]['zone_time'];
		}
		return $student;
	}

	public function getTimeTable($repetitor_id)
	{
		//$q = $this->db->query('select z.zone_time from repetitors r, timezones z where r.tzone_id=z.id and r.id='.$repetitor_id);
		//$r = $q->result_array();
		//$z = $r[0]['zone_time'];
		$q = $this->db->query('select * from exercises where repetitor_id='.$repetitor_id);
		$table = $q->result_array();
		for ($i=0; $i < count($table); $i++) {
			if (!is_null($table[$i]['student_id'])){
				$q = $this->db->query('select first_name from students where id='.$table[$i]['student_id']);
				$r = $q->result_array();
				$table[$i]['student'] = $r[0]['first_name'];
			}
			//$table[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($table[$i]['date_from'])+$z*60*60);
		}
		return $table;
	}

	public function sendChat($chat)
	{
		$this->db->insert('chats', $chat);
		return 0;
	}

	public function sendChat2($chat)
	{
		$this->db->insert('chats', $chat);
		return 0;
	}

	public function getChat($chat)
	{
		$data = array();
		if ($chat['to_role'] == 1){
			//repetitor
			$sel = 'select id, first_name, father_name, avatar, visit_at from repetitors where id='.$chat['to_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data['info'] = $r['0'];
			if ( time() < strtotime($r['0']['visit_at'])+60*5 ){
				$data['info']['online'] = true;
			} else{
				$data['info']['online'] = false;
			}
		} elseif ($chat['to_role'] == 2){
			//stunent
			$sel = 'select id, first_name, father_name, avatar, visit_at from students where id='.$chat['to_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data['info'] = $r['0'];
			if ( time() < strtotime($r['0']['visit_at'])+60*5 ){
				$data['info']['online'] = true;
			} else{
				$data['info']['online'] = false;
			}
		} else{
			//admin
			$data['info'] = array(
				'id'=>0,
				'first_name'=>'Admin',
				'father_name'=>null,
				'avatar'=>null,
				'online'=>true,
			);
		}


		$sel = "update chats set read_at='".$chat['read_at']."' where from_role=".$chat['to_role']." and from_id=".$chat['to_id']." and to_role=".$chat['from_role']." and to_id=".$chat['from_id']." and read_at is null";
		$q = $this->db->query($sel);
		$sel = 'select created_at, message, from_role from chats where (from_role='.$chat['from_role'].' and from_id='.$chat['from_id'].' and to_role='.$chat['to_role'].' and to_id='.$chat['to_id'].') or';
		$sel .= ' (from_role='.$chat['to_role'].' and from_id='.$chat['to_id'].' and to_role='.$chat['from_role'].' and to_id='.$chat['from_id'].') order by id desc limit 50';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$data['chat'] = $r;
		return $data;
	}

	public function getChatList($role, $id)
	{
		$sel = 'select DISTINCT from_id, from_role from chats where to_role='.$role.' and to_id='.$id;
		$q = $this->db->query($sel);
		$data = $q->result_array();
		$sel = 'select DISTINCT to_id, to_role from chats where from_role='.$role.' and from_id='.$id;
		$q = $this->db->query($sel);
		$next = $q->result_array();
		foreach ($next as $n) {
			$find = false;
			if (count($data)>0){
				foreach ($data as $d) {
					if ($n['to_id'] == $d['from_id'] && $n['to_role'] == $d['from_role']){
						$find = true;
					}
				}
			}
			if ($find == false){
				$data[]= array(
					'from_id'=> $n['to_id'],
					'from_role'=>$n['to_role'],
				);
			}
		}
		for ($i=0; $i < count($data); $i++) {
			$sel = 'select count(id) as c from chats where to_role='.$role.' and to_id='.$id.' and from_role='.$data[$i]['from_role'].' and from_id='.$data[$i]['from_id'].' and read_at is null';
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data[$i]['new'] = $r[0]['c'];
			if($data[$i]['from_role'] ==1){
				$sel = 'select first_name, avatar, visit_at, activity from repetitors where id='.$data[$i]['from_id'];
				$q = $this->db->query($sel);
				$r = $q->result_array();
				$data[$i]['first_name'] = $r[0]['first_name'];
				if (is_null($r[0]['avatar'])){
					$data[$i]['avatar'] = null;
				} else{
					$data[$i]['avatar'] = 'images/'.$r[0]['avatar'];
				}
				if (is_null($r[0]['avatar'])){
					$data[$i]['avatar'] = null;
				} else{
					$data[$i]['avatar'] = 'images/'.$r[0]['avatar'];
				}
				if ( (time() < (strtotime($r[0]['visit_at'])+60*5)) && ($r[0]['activity'] >0)){
					$data[$i]['online'] = true;
				} else{
					$data[$i]['online'] = false;
				}
			} elseif($data[$i]['from_role'] == 2){
				$sel = 'select first_name, avatar, visit_at, activity from students where id='.$data[$i]['from_id'];
				$q = $this->db->query($sel);
				$r = $q->result_array();
				$data[$i]['first_name'] = $r[0]['first_name'];
				if (is_null($r[0]['avatar'])){
					$data[$i]['avatar'] = null;
				} else{
					$data[$i]['avatar'] = 'images/'.$r[0]['avatar'];
				}
				if ( (time() < (strtotime($r[0]['visit_at'])+60*5)) && ($r[0]['activity'] >0)){
					$data[$i]['online'] = true;
				} else{
					$data[$i]['online'] = false;
				}
			} else{
				$data[$i]['first_name'] = 'Admin';
				$data[$i]['avatar'] = 'img/avatar_admin.png';
				$data[$i]['online'] = true;
			}
			/* last_date*/
			$sel = 'select max(created_at) as m from chats where (to_role='.$role.' and to_id='.$id.' and from_role='.$data[$i]['from_role'].' and from_id='.$data[$i]['from_id'].') or (to_role='.$data[$i]['from_role'].' and to_id='.$data[$i]['from_id'].' and from_role='.$role.' and from_id='.$id.')';
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data[$i]['last_date'] = $r[0]['m'];
		}
		return $data;
	}

	public function getOneChatUser($to_role, $to_id, $from_role, $from_id)
	{
		$data = array();
		if($from_role == 1){
			$sel = 'select first_name, avatar, visit_at, activity from repetitors where id='.$from_id;
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data['first_name'] = $r[0]['first_name'];
			if (is_null($r[0]['avatar'])){
				$data['avatar'] = null;
			} else{
				$data['avatar'] = 'images/'.$r[0]['avatar'];
			}
			if (is_null($r[0]['avatar'])){
				$data['avatar'] = null;
			} else{
				$data['avatar'] = 'images/'.$r[0]['avatar'];
			}
			if ( (time() < (strtotime($r[0]['visit_at'])+60*5)) && ($r[0]['activity'] >0)){
				$data['online'] = true;
			} else{
				$data['online'] = false;
			}
		} elseif($from_role == 2){
			$sel = 'select first_name, avatar, visit_at, activity status from students where id='.$from_id;
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$data['first_name'] = $r[0]['first_name'];
			if (is_null($r[0]['avatar'])){
				$data['avatar'] = null;
			} else{
				$data['avatar'] = 'images/'.$r[0]['avatar'];
			}
			if ( (time() < (strtotime($r[0]['visit_at'])+60*5)) && ($r[0]['activity'] >0)){
				$data['online'] = true;
			} else{
				$data['online'] = false;
			}
		} else{
			$data['first_name'] = 'Admin';
			$data['avatar'] = 'img/avatar_admin.png';
			$data['online'] = true;
		}
		$sel = 'select max(created_at) as m from chats where (to_role='.$to_role.' and to_id='.$to_id.' and from_role='.$from_role.' and from_id='.$from_id.') or (to_role='.$from_role.' and to_id='.$from_id.' and from_role='.$to_role.' and from_id='.$to_id.')';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			$data['last_date'] = null;
		} else{
			$data['last_date'] = $r[0]['m'];
		}
		$sel = 'select count(id) as c from chats where to_role='.$to_role.' and to_id='.$to_id.' and from_role='.$from_role.' and from_id='.$from_id.' and read_at is null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$data['new'] = $r[0]['c'];
		return $data;
	}

	public function getTotalBalance()
	{
		$sel = 'select balance from balance limit 1';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		return $r[0]['balance'];
	}

	public function sendfeed($feed)
	{
		$q = $this->db->query('select id from ratings where student_id='.$feed['student_id'].' and repetitor_id='.$feed['repetitor_id']);
		$r = $q->result_array();
		if (count($r)>0){
			return 1;
		} else{
			$this->db->insert('ratings', $feed);
			$q = $this->db->query('select sum(rating) as s, count(student_id) as c from ratings where repetitor_id='.$feed['repetitor_id']);
			$r = $q->result_array();
			$reight = round($r[0]['s'] / $r[0]['c']);
			$this->db->where('id', $feed['repetitor_id']);
			$this->db->update('repetitors', array('reight'=> $reight));
			return 0;
		}
	}

	public function getFeeds($repetitor_id)
	{
		$q = $this->db->query('select r.rating, r.about, r.created_at, s.first_name, s.father_name from ratings as r, students as s where r.student_id=s.id and r.repetitor_id='.$repetitor_id.' order by created_at DESC');
		$r = $q->result_array();
		return $r;
	}

	public function canFeed($student_id, $repetitor_id)
	{
		$q = $this->db->query('select id from ratings where student_id='.$student_id.' and repetitor_id='.$repetitor_id);
		$r = $q->result_array();
		$can = true;
		if (count($r)>0){
			$can = false;
		}
		///
		$q = $this->db->query('select rstart_at from exercises where student_id='.$student_id.' and repetitor_id='.$repetitor_id.' and rstart_at is not null');
		$r = $q->result_array();
		if (count($r)==0){
			$can = false;
		}
		return $can;
	}

	public function getRZone($repetitor_id)
	{
		$sel = 'select t.zone_time from timezones t, repetitors r where t.id=r.tzone_id and r.id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			return 0;
		} else{
			return $r[0]['zone_time'];
		}
	}

	public function getSZone($student_id)
	{
		$sel = 'select t.zone_time from timezones t, students s where t.id=s.tzone_id and s.id='.$student_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			return 0;
		} else{
			return $r[0]['zone_time'];
		}
	}

	public function getTimeZones()
	{
		$sel = 'select * from timezones';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		return $r;
	}

	public function getOldLessons()
	{
		$date = date('Y-m-d H:i:s', time()-60*60);
		$q = $this->db->query('select * from exercises where rstart_at is null and date_from<"'.$date.'" and pay_at is not null and deleted_at is null');
		$r = $q->result_array();
		return $r;
	}

	public function addStudentBalance($student_id, $sum)
	{
		$q = $this->db->query('select balance from students where id='.$student_id);
		$r = $q->result_array();
		$balance = $r[0]['balance'] + $sum;
		$this->db->where('id', $student_id);
		$this->db->update('students', array('balance'=>$balance));
		return 0;
	}

	public function decRepetitorBalance($repetitor_id, $sum)
	{
		$q = $this->db->query('select balance from repetitors where id='.$repetitor_id);
		$r = $q->result_array();
		$balance = $r[0]['balance'] - $sum;
		$this->db->where('id', $repetitor_id);
		$this->db->update('repetitors', array('balance'=>$balance));
		return 0;
	}

	public function setDeletedLesson($lesson_id)
	{
		$this->db->where('id', $lesson_id);
		$this->db->update('exercises', array('deleted_at'=>date('Y-m-d H:i:s', time())));
		return 0;
	}

	public function AllFiltered($filter)
	{
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
			$fil .= ' and activity=1 and r.visit_at>"'.$online.'"';
		}
		if ($filter->video){
			$fil .= ' and r.link is not null and not link=""';
		}
		if ($filter->date_from){
			$time_from = $filter->date_from;
		}
		$fil .= ' and rsp.cost>='.round($filter->cost_from/1.3).' and rsp.cost<='.round($filter->cost_to/1.3);
		log_message('error', 'FIL='.$fil);
		$sel = 'select DISTINCT r.reight, r.activity, t.zone_time, r.id, r.avatar, r.lang_id, r.subject1, r.subject2, r.link, r.visit_at, r.first_name, r.about, r.father_name  from repetitors as r, rsa, rsp, rsl, rss, timezones as t where t.id=r.tzone_id and rsa.repetitor_id=r.id and rsl.repetitor_id=r.id and (rsp.subject_id=r.subject1 or rsp.subject_id=r.subject2)  and rsp.repetitor_id=r.id and rss.repetitor_id=r.id and r.status=2 '.$fil.' order by  r.reight DESC, r.visit_at DESC';
		$q = $this->db->query($sel);
		$temp = $q->result_array();
		$repetitors = array();
		$i = 0;
		foreach ($temp as $t) {
			$find = true;
			if ($filter){
				if ($filter->subject_id){
					if ($filter->subject_id !=$t['subject1']){
						$find = false;
					}
				}
			}
			//$find = true;
			if ($find){
				$repetitors[$i] = array(
					'activity'=>$t['activity'],
					'zone_time'=>$t['zone_time'],
					'id'=>$t['id'],
					'avatar'=>$t['avatar'],
					'lang_id'=>$t['lang_id'],
					'subject_id'=>$t['subject1'],
					'link'=>$t['link'],
					'visit_at'=>$t['visit_at'],
					'first_name'=>$t['first_name'],
					'about'=>$t['about'],
					'father_name'=>$t['father_name'],
					'reight'=>$t['reight'],
				);
				$i++;
			}
			$find = true;
			if ($filter){
				if ($filter->subject_id){
					if ($filter->subject_id !=$t['subject2']){
						$find = false;
					}
				}
			}
			//$find = true;
			if (!is_null($t['subject2']) && $find){
				$repetitors[$i] = array(
					'activity'=>$t['activity'],
					'zone_time'=>$t['zone_time'],
					'id'=>$t['id'],
					'avatar'=>$t['avatar'],
					'lang_id'=>$t['lang_id'],
					'subject_id'=>$t['subject2'],
					'link'=>$t['link'],
					'visit_at'=>$t['visit_at'],
					'first_name'=>$t['first_name'],
					'about'=>$t['about'],
					'father_name'=>$t['father_name'],
					'reight'=>$t['reight'],
				);
				$i++;
			}
		}
		$temp = array();
		for ($i=0; $i < count($repetitors); $i++) {
			$sel = 'select language from languages where id='.$repetitors[$i]['lang_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['language'] = $r[0]['language'];
			$sel = 'select subject from subjects where id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['subject'] = $r[0]['subject'];
			$sel = 'select DISTINCT s.specialization from specializations as s, rss where rss.specialization_id=s.id and rss.repetitor_id='.$repetitors[$i]['id'].' and rss.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['spec'] = array();
			foreach ($r as $k) {
				$repetitors[$i]['spec'][] = $k['specialization'];
			}
			$sel = 'select DISTINCT a.age from ages as a, rsa where rsa.age_id=a.id and rsa.repetitor_id='.$repetitors[$i]['id'].' and rsa.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['ages'] = array();
			foreach ($r as $k) {
				$repetitors[$i]['ages'][] = $k['age'];
			}
			$sel = 'select DISTINCT cost from rsp where repetitor_id='.$repetitors[$i]['id'].' and rsp.subject_id='.$repetitors[$i]['subject_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitors[$i]['cost'] = round($r[0]['cost']*1.3);
			if ( (time() < (strtotime($repetitors[$i]['visit_at'])+60*5)) && ($repetitors[$i]['activity'] >0)){
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
					$time_from = $date_from + $filter->time_from*60*60;
					$time_to = $date_from + $filter->time_to*60*60;
					log_message('error', 'FILTER TIME from='.date('Y-m-d H:i:s', $time_from));
					log_message('error', 'FILTER TIME to='.date('Y-m-d H:i:s', $time_to));
					$log_err = 'FILTER TIME from='.date('Y-m-d H:i:s', $time_from).' '.'FILTER TIME to='.date('Y-m-d H:i:s', $time_to);
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
}
