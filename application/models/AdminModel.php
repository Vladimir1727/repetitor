<?php
class AdminModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->dbforge();
		$this->load->library('session');
	}

    public function createDB()
    {/*
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'zone_name'=>array(
                'type'=>'VARCHAR',
                'constraint' => '100',
            ),
			'zone_time'=>array(
                'type'=>'tinyint',
                'constraint' => 3,
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('timezones', TRUE);
		$insert = array(
			array('zone_name'=> 'UTC (GMT) Гринвич, Лондон, Рейкьявик, Лиссабон, Дакар','zone_time'=>0),
			array('zone_name'=> 'UTC +1	 Рим, Париж, Берлин, Осло, Мадрид, Копенгаген, Вена','zone_time'=>1),
			array('zone_name'=> 'UTC +2	 Киев, Минск, Анкара, Афины, Иерусалим, Хельсинки, София, Бухарест, Кейптаун','zone_time'=>2),
			array('zone_name'=> 'UTC +3	 Москва, Аддис-Абеба, Багдад','zone_time'=>3),
			array('zone_name'=> 'UTC +4	 Тегеран, Баку, Абу-Даби','zone_time'=>4),
			array('zone_name'=> 'UTC +5	 Душанбе, Ташкент, Карачи','zone_time'=>5),
			array('zone_name'=> 'UTC +6	 Алматы, Тюмень','zone_time'=>6),
			array('zone_name'=> 'UTC +7	 Новосибирск, Джакарта, Бангкок','zone_time'=>7),
			array('zone_name'=> 'UTC +8	 Иркутск, Пекин, Шанхай','zone_time'=>8),
			array('zone_name'=> 'UTC +9	 Токио, Сеул, Пхеньян','zone_time'=>9),
			array('zone_name'=> 'UTC +10 Канберра, Сидней, Мельбурн','zone_time'=>0),
			array('zone_name'=> 'UTC +11 Магадан','zone_time'=>11),
			array('zone_name'=> 'UTC +12 Веллингтон','zone_time'=>12),
			array('zone_name'=> 'UTC -12 Анадырь, Камчатка','zone_time'=>-12),
			array('zone_name'=> 'UTC -11 Ном (Аляска), Самоа','zone_time'=>-11),
			array('zone_name'=> 'UTC -10 Аляска, Гавайи','zone_time'=>-10),
			array('zone_name'=> 'UTC -9	','zone_time'=>-9),
			array('zone_name'=> 'UTC -8	Лос-Анджелес, Сан-Франциско, Сиэтл, Ванкувер','zone_time'=>-8),
			array('zone_name'=> 'UTC -7	Денвер, Феникс, о.Пасхи','zone_time'=>-7),
			array('zone_name'=> 'UTC -6 Гватемала','zone_time'=>-6),
			array('zone_name'=> 'UTC -5	Нью-Йорк, Вашингтон, Атланта, Оттава, Гавана, Богота, Лима','zone_time'=>-5),
			array('zone_name'=> 'UTC -4	Ла-Пас, Каракас, Галифакс','zone_time'=>-4),
			array('zone_name'=> 'UTC -3	Асунсьон, Буэнос-Айрес','zone_time'=>-3),
			array('zone_name'=> 'UTC -2	Сан-Паулу, Бразилиа','zone_time'=>-2),
			array('zone_name'=> 'UTC -1	Азорские о-ва','zone_time'=>-1),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('timezones', $ins);
			$this->db->query($str);
		}
		$fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'subject'=>array(
                'type'=>'VARCHAR',
                'constraint' => '50',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('subjects', TRUE);

		$fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'subject'=>array(
                'type'=>'VARCHAR',
                'constraint' => '50',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('subjects', TRUE);
		$insert = array(
			array('subject'=> 'Английский язык'),
			array('subject'=> 'Французский язык'),
			array('subject'=> 'Немецкий язык'),
			array('subject'=> 'Итальянский язык'),
			array('subject'=> 'Испанский язык'),
			array('subject'=> 'Русский язык'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('subjects', $ins);
			$this->db->query($str);
		}

		$fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'language'=>array(
                'type'=>'VARCHAR',
                'constraint' => '50',
            ),
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('languages', TRUE);
		$insert = array(
			array('language'=> 'Азербайджанский язык'),
			array('language'=> 'Албанский язык'),
			array('language'=> 'Английский язык'),
			array('language'=> 'Арабский язык'),
			array('language'=> 'Армянский язык'),
			array('language'=> 'Белорусский язык'),
			array('language'=> 'Болгарский язык'),
			array('language'=> 'Венгерский язык'),
			array('language'=> 'Вьетнамский язык'),
			array('language'=> 'Голландский язык'),
			array('language'=> 'Древнегреческий язык (Греческий Древний)'),
			array('language'=> 'Греческий (Новогреческий язык)'),
			array('language'=> 'Грузинский язык'),
			array('language'=> 'Дари (Фарси)'),
			array('language'=> 'Датский язык'),
			array('language'=> 'Иврит'),
			array('language'=> 'Испанский язык'),
			array('language'=> 'Итальянский язык'),
			array('language'=> 'Кыргызский язык'),
			array('language'=> 'Казахский язык'),
			array('language'=> 'Китайский язык'),
			array('language'=> 'Корейский язык'),
			array('language'=> 'Латинский язык (Латынь)'),
			array('language'=> 'Латышский язык (Латвийский)'),
			array('language'=> 'Литовский язык'),
			array('language'=> 'Малазийский язык'),
			array('language'=> 'Молдавский язык'),
			array('language'=> 'Монгольский язык'),
			array('language'=> 'Немецкий язык'),
			array('language'=> 'Непальский язык'),
			array('language'=> 'Нидерландский язык (Голландский)'),
			array('language'=> 'Норвежский язык'),
			array('language'=> 'Персидский язык'),
			array('language'=> 'Польский язык'),
			array('language'=> 'Португальский язык'),
			array('language'=> 'Румынский язык'),
			array('language'=> 'Русский язык'),
			array('language'=> 'Сербский язык (Сербохорватский)'),
			array('language'=> 'Словацкий язык'),
			array('language'=> 'Словенский язык'),
			array('language'=> 'Таджикский язык'),
			array('language'=> 'Тайский язык'),
			array('language'=> 'Татарский язык'),
			array('language'=> 'Турецкий язык'),
			array('language'=> 'Туркменский язык'),
			array('language'=> 'Украинский язык'),
			array('language'=> 'Узбекский язык'),
			array('language'=> 'Фарси (Дари)'),
			array('language'=> 'Финский язык'),
			array('language'=> 'Фламандский язык'),
			array('language'=> 'Французский язык'),
			array('language'=> 'Хинди'),
			array('language'=> 'Хорватский язык (Сербохорватский)'),
			array('language'=> 'Чешский язык'),
			array('language'=> 'Шведский язык'),
			array('language'=> 'Эстонский язык'),
			array('language'=> 'Японский язык'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('languages', $ins);
			$this->db->query($str);
		}

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'uni_degree'=>array(
				'type'=>'VARCHAR',
				'constraint' => '50',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('uni_degrees', TRUE);
		$insert = array(
			array('uni_degree'=> 'нет'),
			array('uni_degree'=> 'Кандидат наук'),
			array('uni_degree'=> 'Доктор наук'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('uni_degrees', $ins);
			$this->db->query($str);
		}

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'specialization'=>array(
				'type'=>'VARCHAR',
				'constraint' => '50',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('specializations', TRUE);
		$insert = array(
			array('specialization'=> 'Разговорный язык'),
			array('specialization'=> 'ГИА, ОГЭ'),
			array('specialization'=> 'ЕГЭ'),
			array('specialization'=> 'Подготовка к экзаменам'),
			array('specialization'=> 'Язык с нуля'),
			array('specialization'=> 'Деловой язык'),
			array('specialization'=> 'Туризм'),
			array('specialization'=> 'Для учёбы за рубежом'),
			array('specialization'=> 'Грамматика'),
			array('specialization'=> 'Повышение успеваемости'),
			array('specialization'=> 'Помощь при выполнении домашнего задания'),
			array('specialization'=> 'Подготовка к Международным экзаменам'),
			array('specialization'=> 'Подготовка к олимпиаде'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('specializations', $ins);
			$this->db->query($str);
		}
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'age'=>array(
				'type'=>'VARCHAR',
				'constraint' => '50',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('ages', TRUE);
		$insert = array(
			array('age'=> 'Начальная школа (1-4 класс)'),
			array('age'=> 'Средняя школа (5-9 класс)'),
			array('age'=> 'Старшая школа (10-11 класс)'),
			array('age'=> 'Студент'),
			array('age'=> 'Взрослый'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('ages', $ins);
			$this->db->query($str);
		}
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'level'=>array(
				'type'=>'VARCHAR',
				'constraint' => '50',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('levels', TRUE);
		$insert = array(
			array('level'=> 'Начинающий'),
			array('level'=> 'Средний'),
			array('level'=> 'Выше среднего'),
			array('level'=> 'Продвинутый'),
		);
		foreach ($insert as $ins) {
			$str = $this->db->insert_string('levels', $ins);
			$this->db->query($str);
		}
		$table = 'CREATE TABLE repetitors(
			id int not null auto_increment primary key,
			email varchar(128) NOT NULL UNIQUE,
			password varchar(128) NOT NULL,
			last_name varchar(64) DEFAULT NULL,
			first_name varchar(64) DEFAULT NULL,
			father_name varchar(64) DEFAULT NULL,
			tzone_id int unsigned DEFAULT NULL,
			foreign key (tzone_id) references timezones(id) on update cascade,
			skype varchar(128) DEFAULT NULL,
			university varchar(128) DEFAULT NULL,
			uni_year year DEFAULT NULL,
			specialty varchar(128) DEFAULT NULL,
			degree_id int unsigned DEFAULT NULL,
			foreign key (degree_id) references uni_degrees(id) on update cascade,
			experience tinyint unsigned DEFAULT 0,
			exp_comment varchar(1000) default NULL,
			lang_id int unsigned default null,
			foreign key (lang_id) references languages(id) on update cascade,
			about varchar(1000) default NULL,
			avatar varchar(256) default NULL,
			link  varchar(512) default NULL,
			yandex varchar (64) default NULL,
			paypal varchar (64) default NULL,
			activity tinyint default 0,
			status tinyint default 0,
			reight tinyint default 0,
			balance int unsigned default 0,
			phone varchar (20) default NULL,
			subject1 int(5) unsigned default NULL,
			subject2 int(5) unsigned default NULL,
			doc1 varchar (256) default NULL,
			doc2 varchar (256) default NULL,
			created_at datetime,
			visit_at datetime,
			foreign key (subject1) references subjects(id) on update cascade,
			foreign key (subject2) references subjects(id) on update cascade
		)default charset=utf8';
		$this->db->query($table);
		$table = 'CREATE TABLE students(
			id int not null auto_increment primary key,
			email varchar(128) NOT NULL UNIQUE,
			password varchar(128) NOT NULL,
			last_name varchar(64) DEFAULT NULL,
			first_name varchar(64) DEFAULT NULL,
			father_name varchar(64) DEFAULT NULL,
			tzone_id int unsigned DEFAULT NULL,
			foreign key (tzone_id) references timezones(id) on update cascade,
			skype varchar(128) DEFAULT NULL,
			avatar varchar(256) default NULL,
			status tinyint default 0,
			phone varchar (20) default NULL,
			created_at datetime,
			visit_at datetime,
			activity tinyint default 0,
			balance int unsigned default 0
		)default charset=utf8';
		$this->db->query($table);*/
		$table = 'CREATE TABLE exercises(
				id int not null auto_increment primary key,
				date_from datetime DEFAULT NULL,
				date_accept datetime DEFAULT NULL,
				created_at datetime DEFAULT NULL,
				deleted_at datetime DEFAULT NULL,
				pay_at datetime DEFAULT NULL,
				sstart_at datetime DEFAULT NULL,
				rstart_at datetime DEFAULT NULL,
				cancel_at datetime DEFAULT NULL,
				cost int unsigned default 0,
				student_id int DEFAULT NULL,
				CONSTRAINT FK_ExSt foreign key (student_id) references students(id) on update cascade,
				repetitor_id int DEFAULT NULL,
				CONSTRAINT FK_ExRep foreign key (repetitor_id) references repetitors(id) on update cascade,
				subject_id int(5) unsigned DEFAULT NULL,
				CONSTRAINT FK_ExSub foreign key (subject_id) references subjects(id) on update cascade,
				specialization_id int(5) unsigned DEFAULT NULL,
				CONSTRAINT FK_Sp foreign key (specialization_id) references specializations(id) on update cascade,
				about varchar(1024) default null,
				deleted tinyint default 0
			)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE chats(
					id int not null auto_increment primary key,
					created_at datetime,
					from_role tinyint,
					from_id int(10) default 0,
					to_role tinyint,
					to_id int(10) default 0,
					message varchar(1024)
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE queue(
					id int not null auto_increment primary key,
					created_at datetime,
					done_at datetime,
					type tinyint,
					type_id int unsigned,
					is_done tinyint default 0
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE balance_adds(
					id int not null auto_increment primary key,
					cost int,
					created_at datetime,
					student_id int,
					type varchar(256) default NULL,
					foreign key (student_id) references students(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE salaries(
					id int not null auto_increment primary key,
					cost int,
					created_at datetime default null,
					done_at datetime default null,
					repetitor_id int DEFAULT NULL,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					is_done tinyint default 0,
					type varchar(32) default null,
					deleted_at datetime default null
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE ratings(
					id int not null auto_increment primary key,
					rating tinyint,
					created_at datetime,
					repetitor_id int DEFAULT NULL,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					student_id int,
					foreign key (student_id) references students(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE favorites(
					id int not null auto_increment primary key,
					created_at datetime,
					repetitor_id int DEFAULT NULL,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					student_id int,
					foreign key (student_id) references students(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE free_apps(
					id int not null auto_increment primary key,
					date_from datetime DEFAULT NULL,
					date_to datetime DEFAULT NULL,
					created_at datetime,
					deleted_at datetime DEFAULT NULL,
					cancel_at datetime DEFAULT NULL,
					cost int unsigned default 0,
					student_id int,
					foreign key (student_id) references students(id) on update cascade,
					subject_id int(5) unsigned DEFAULT NULL,
					foreign key (subject_id) references subjects(id) on update cascade,
					specialization_id int(5) unsigned DEFAULT NULL,
					foreign key (specialization_id) references specializations(id) on update cascade,
					about varchar(1024) default null,
					abut_time varchar(1024) default null,
					deleted tinyint default 0
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE balance(
					id int not null auto_increment primary key,
					balance int
				)default charset=utf8';
			$this->db->query($table);
			$this->db->query('insert into balance (balance) values (0)');
			$table = 'CREATE TABLE documents(
					id int not null auto_increment primary key,
					repetitor_id int DEFAULT NULL,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					document varchar(512)
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE rsa(
					id int not null auto_increment primary key,
					subject_id int(5) unsigned,
					foreign key (subject_id) references subjects(id) on update cascade,
					repetitor_id int,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					age_id int(5) unsigned,
					foreign key (age_id) references ages(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE rsl(
					id int not null auto_increment primary key,
					subject_id int(5) unsigned,
					foreign key (subject_id) references subjects(id) on update cascade,
					repetitor_id int,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					level_id int(5) unsigned,
					foreign key (level_id) references levels(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE rss(
					id int not null auto_increment primary key,
					subject_id int(5) unsigned,
					foreign key (subject_id) references subjects(id) on update cascade,
					repetitor_id int,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					specialization_id int(5) unsigned DEFAULT NULL,
					foreign key (specialization_id) references specializations(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE rsp(
					id int not null auto_increment primary key,
					subject_id int(5) unsigned,
					foreign key (subject_id) references subjects(id) on update cascade,
					repetitor_id int,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					cost int unsigned default 0
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE free_rs(
					id int not null auto_increment primary key,
					created_at datetime default null,
					repetitor_id int,
					foreign key (repetitor_id) references repetitors(id) on update cascade,
					free_id int,
					accepted tinyint default null,
					admin tinyint default null,
					foreign key (free_id) references free_apps(id) on update cascade
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE other(
					id int not null auto_increment primary key,
					name varchar (128),
					sense varchar (128)
				)default charset=utf8';
			$this->db->query($table);
			$ins = array('name'=>'admin_password', 'sense'=>'1111');
			$str = $this->db->insert_string('other', $ins);
			$this->db->query($str);
			$table = 'CREATE TABLE rep_pays(
					id int not null auto_increment primary key,
					created_at datetime,
					student_id int,
					lessons tinyint,
					cost int
				)default charset=utf8';
			$this->db->query($table);
			$table = 'CREATE TABLE events(
					id int not null auto_increment primary key,
					created_at datetime,
					event varchar(2048),
					type varchar(128)
				)default charset=utf8';
			$this->db->query($table);
		return 'DB created';
    }

	public function createTable()
	{
		// $str = 'ALTER TABLE chats
		// 	ADD read_at datetime default null';
		// 	$this->db->query($str);
		$table = 'CREATE TABLE events(
				id int not null auto_increment primary key,
				created_at datetime,
				event varchar(2048),
				type varchar(128)
			)default charset=utf8';
		$this->db->query($table);
		return 'table created';
	}

	public function seed()
	{
		$ins = array('name'=>'admin_password', 'sense'=>'1111');
		$str = $this->db->insert_string('other', $ins);
		$this->db->query($str);
		return 'table seeded';
	}

	public function login($pass)
	{
		$q = $this->db->query('select sense from other where sense="'.$pass.'" and name="admin_password"');
		$r = $q->result_array();
		if (count($r) == 0){
			throw new Exception('неправильный логин/пароль');
		} else{
			$this->session->set_userdata('admin', 'admin');
			return '0';
		}
	}

	function serverZone($date)
	{
		$szone = date('H',time())-gmdate('H', time());
		return date('Y-m-d H:i:s', strtotime($date) + $szone*60*60);
	}

	public function getAllRepetitors()
	{

		$q = $this->db->query('select * from repetitors');
		$repetitors = $q->result_array();
		for($i = 0; $i < count($repetitors); $i++){
			//$repetitors[$i]['created_at'] = $this->serverZone($repetitors[$i]['created_at']);
			if ($repetitors[$i]['subject1']){
				$sub = $repetitors[$i]['subject1'];
				$q = $this->db->query('select subject from subjects where id='.$sub);
				$row = $q->result_array();
				$repetitors[$i]['subject1_name'] = $row[0]['subject'];
			}
			if ($repetitors[$i]['subject2']){
				$sub = $repetitors[$i]['subject2'];
				$q = $this->db->query('select subject from subjects where id='.$sub);
				$row = $q->result_array();
				$repetitors[$i]['subject2_name'] = $row[0]['subject'];
			}
			//кол-во учеников
			$sel = 'select student_id from exercises where repetitor_id='.$repetitors[$i]['id'].' and student_id is not null and pay_at is not null and date_accept is not null and cancel_at is null group by student_id ';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			$repetitors[$i]['students'] = count($row);
			//кол-во заявок
			$date = date('Y-m-d H:i:s', time());
			$sel = 'select date_from from exercises where deleted_at is null and date_accept is null and cost>0 and cancel_at is null and repetitor_id='.$repetitors[$i]['id'].' and student_id is not null group by date_from';
			//$sel = 'select date_from from exercises where deleted_at is null and date_from>"'.$date.'" and date_accept is null and cost>0 and cancel_at is null and repetitor_id='.$repetitors[$i]['id'].' and student_id is not null group by date_from';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			$repetitors[$i]['req'] = count($row);
			//кол-во уроков
			$sel = 'select * from exercises where deleted_at is null and date_accept is not null and cost>0 and cancel_at is null and repetitor_id='.$repetitors[$i]['id'].' and student_id is not null and rstart_at is not null';
			//$sel = 'select * from exercises where deleted_at is null and date_accept is not null and date_from>"'.$date.'" and cost>0 and cancel_at is null and repetitor_id='.$repetitors[$i]['id'].' and student_id is not null and rstart_at is not null';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			$repetitors[$i]['lessons'] = count($row);
			//ко-во уроков с одним учеником
			$sel = 'select student_id, count(student_id) as c from exercises where deleted_at is null and date_accept is not null and date_from>"'.$date.'" and cost>0 and cancel_at is null and repetitor_id='.$repetitors[$i]['id'].' and student_id is not null and rstart_at is not null group by student_id';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			$s = 0;
			$l = 0;
			foreach ($row as $r) {
				$s++;
				$l += $r['c'];
			}
			if ($s == 0){
				$repetitors[$i]['ls'] = 0;
			} else{
				$repetitors[$i]['ls'] = $l/$s;
			}
			//заработал всего
			$sel = 'select sum(cost) as s from rep_pays where repetitor_id='.$repetitors[$i]['id'];
			$q = $this->db->query($sel);
			$row = $q->result_array();
			if (is_null($row[0]['s'])){
				$repetitors[$i]['pay'] = 0;
			} else{
				$repetitors[$i]['pay'] = $row[0]['s'];
			}
			//заработала система
			$repetitors[$i]['system'] = round($repetitors[$i]['pay']*0.3);
		}
		return $repetitors;
	}

	public function getAllStudents()
	{
		$q = $this->db->query('select * from students');
		$students = $q->result_array();
		for($i = 0; $i < count($students); $i++){
			//запросов на уроки
			//$students[$i]['created_at'] = $this->serverZone($students[$i]['created_at']);
			$sel = 'select count(id) as c from exercises where deleted_at is null and cost>0 and cancel_at is null and student_id='.$students[$i]['id'].' and pay_at is null';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			if (is_null($row[0]['c'])){
				$students[$i]['req'] = 0;
			} else{
				$students[$i]['req'] = $row[0]['c'];
			}
			//свободные заявки
			$sel = 'select count(id) as c from free_apps as f where f.student_id='.$students[$i]['id'].' and f.deleted_at is null';
			$q = $this->db->query($sel);
			$row = $q->result_array();
			if (is_null($row[0]['c'])){
				$students[$i]['free'] = 0;
			} else{
				$students[$i]['free'] = $row[0]['c'];
			}
			//купил уроков
			$sel = 'select count(id) as c, sum(cost) as s from rep_pays where student_id='.$students[$i]['id'];
			$q = $this->db->query($sel);
			$row = $q->result_array();
			if (is_null($row[0]['c'])){
				$students[$i]['buy'] = 0;
				$students[$i]['sum'] = 0;
			} else{
				$students[$i]['buy'] = $row[0]['c'];
				$students[$i]['sum'] = round($row[0]['s']*0.3);
			}
			//общая сумма пополнений
			$sel = 'select sum(cost) as c from balance_adds where status=1 and student_id='.$students[$i]['id'];
			$q = $this->db->query($sel);
			$row = $q->result_array();
			if (is_null($row[0]['c'])){
				$students[$i]['adds'] = 0;
			} else{
				$students[$i]['adds'] = $row[0]['c'];
			}
		}
		return $students;
	}

	public function setRepetitorStatus($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update('repetitors', array('status'=>$status));
		return 0;
	}

	public function setStudentStatus($id, $status)
	{
		$this->db->where('id', $id);
		$this->db->update('students', array('status'=>$status));
		return 0;
	}

	public function getUsers()
	{
		$users = array();
		$sel = 'select id, first_name, father_name, last_name from repetitors';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		foreach ($row as $r) {
			$data[] = array(
				'id' => $r['id'],
				'first_name' => (is_null($r['first_name'])) ? '' : $r['first_name'],
				'last_name' => (is_null($r['last_name'])) ? '' : $r['last_name'],
				'father_name' => (is_null($r['father_name'])) ? '' : $r['father_name'],
				'role' =>1,
			);
		}
		$sel = 'select id, first_name, father_name, last_name from students';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		foreach ($row as $r) {
			$data[] = array(
				'id' => $r['id'],
				'first_name' => (is_null($r['first_name'])) ? '' : $r['first_name'],
				'last_name' => (is_null($r['last_name'])) ? '' : $r['last_name'],
				'father_name' => (is_null($r['father_name'])) ? '' : $r['father_name'],
				'role' =>2,
			);
		}
		return $data;
	}

	public function getNewFreeRequests()
	{
		$sel = 'select *, (select first_name from students where id=f.student_id) as student_name, (select subject from subjects where id=f.subject_id) as subject from free_apps as f where f.admin is null and f.deleted_at is null';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		for ($i=0; $i < count($row); $i++) {
			//$row[$i]['created_at'] = $this->serverZone($row[$i]['created_at']);
		}
		return $row;
	}

	public function getAcceptedFreeRequests()
	{
		$sel = 'select *, (select first_name from students where id=f.student_id) as student_name, (select subject from subjects where id=f.subject_id) as subject from free_apps as f where f.admin=1 and f.deleted_at is null';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		for ($i=0; $i < count($row); $i++) {
			//$row[$i]['created_at'] = $this->serverZone($row[$i]['created_at']);
			$sel = 'select repetitor_id from free_rs where free_id='.$row[$i]['id'].' and accepted=1 group by repetitor_id';
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$row[$i]['req'] = count($r);
		}
		return $row;
	}

	public function delFree($id)
	{
		$this->db->where('id', $id);
		$this->db->update('free_apps', array('deleted_at'=>date('Y-m-d H:i:s', time())));
		return 0;
	}

	public function acceptFree($id)
	{
		$this->db->where('id', $id);
		$this->db->update('free_apps', array('admin'=>1) );
		return 0;
	}

	public function editFree($id, $about, $about_time)
	{
		$up = array(
			'about'=>$about,
			'about_time'=>$about_time,
		);
		$this->db->where('id', $id);
		$this->db->update('free_apps', $up);
		return 0;
	}

	public function getFreeRepetitors($free_id)
	{
		$sel = 'select r.id, r.first_name, r.father_name, fa.subject_id from repetitors as r, free_apps as fa, free_rs as fr where fr.repetitor_id=r.id and fr.free_id=fa.id and fr.accepted=1 and fr.free_id='.$free_id;
		$q = $this->db->query($sel);
		$row = $q->result_array();
		for ($i=0; $i < count($row); $i++) {

		}
		return $row;
	}

	public function getSalaryRequests()
	{
		$sel = 'select * from salaries where deleted_at is null order by created_at DESC';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		for ($i=0; $i < count($row); $i++) {
			//$row[$i]['created_at'] = $this->serverZone($row[$i]['created_at']);
			$q = $this->db->query('select first_name, father_name, yandex, paypal, master from repetitors where id='.$row[$i]['repetitor_id']);
			$rep = $q->result_array();
			if (is_null($rep[0]['first_name'])){
				$row[$i]['repetitor'] = 'Без имени';
			} else{
				$row[$i]['repetitor'] = $rep[0]['first_name'];
				if (is_null($rep[0]['father_name'])){
					$row[$i]['repetitor'].= ' '.$rep[0]['father_name'];
				}
			}
			if ($row[$i]['type'] == 'yandex'){
				$row[$i]['type'] = 'ЯндексДеньги';
				if (is_null($rep[0]['yandex'])){
					$row[$i]['req'] = 'Нет данных';
				} else{
					$row[$i]['req'] = $rep[0]['yandex'];
				}
			} elseif($row[$i]['type'] == 'paypal'){
				$row[$i]['type'] = 'PayPal';
				if (is_null($rep[0]['paypal'])){
					$row[$i]['req'] = 'Нет данных';
				} else{
					$row[$i]['req'] = $rep[0]['yandex'];
				}
			} else{
				$row[$i]['type'] = 'Visa / Mastercard / Maestro';
				if (is_null($rep[0]['master'])){
					$row[$i]['req'] = 'Нет данных';
				} else{
					$row[$i]['req'] = $rep[0]['master'];
				}
			}
		}
		return $row;
	}

	public function history()
	{
		$sel = 'select * from exercises where date_accept is not null and pay_at is not null and date_from<now() order by date_from DESC';
		$q = $this->db->query($sel);
		$lessons = $q->result_array();
		for ($i=0; $i < count($lessons); $i++) {
			$lessons[$i]['date_from'] = $this->serverZone($lessons[$i]['date_from']);
			$q = $this->db->query('select first_name from students where id='.$lessons[$i]['student_id']);
			$r = $q->result_array();
			if (is_null($r[0]['first_name'])){
				$lessons[$i]['student'] = 'Без имени';
			} else{
				$lessons[$i]['student'] = $r[0]['first_name'];
			}
			$q = $this->db->query('select first_name from repetitors where id='.$lessons[$i]['repetitor_id']);
			$r = $q->result_array();
			if (is_null($r[0]['first_name'])){
				$lessons[$i]['repetitor'] = 'Без имени';
			} else{
				$lessons[$i]['repetitor'] = $r[0]['first_name'];
			}
			$q = $this->db->query('select subject from subjects where id='.$lessons[$i]['subject_id']);
			$r = $q->result_array();
			$lessons[$i]['subject'] = $r[0]['subject'];
			$q = $this->db->query('select specialization from specializations where id="'.$lessons[$i]['specialization_id'].'"');
			$r = $q->result_array();
			if (count($r)==0){
				$lessons[$i]['specialization'] = '';
			} else{
				$lessons[$i]['specialization'] = $r[0]['specialization'];
			}
			if (is_null($lessons[$i]['about'])){
				$lessons[$i]['about'] = '';
			}
			if (!is_null($lessons[$i]['cancel_at']) || !is_null($lessons[$i]['cancel_at'])){
				$lessons[$i]['status'] = 'Отменён';
			} elseif (!is_null($lessons[$i]['rstart_at'])){
				$lessons[$i]['status'] = 'Проведён';
			} else{
				$lessons[$i]['status'] = 'Не проведён';
			}
		}
		return $lessons;
	}

	public function delSalary($id)
	{
		$this->db->where('id', $id);
		$this->db->update('salaries', array('deleted_at'=>date('Y-m-d H:i:s', time())));
		return 0;
	}

	public function acceptSalary($id)
	{
		$q = $this->db->query('select s.repetitor_id, r.balance, s.cost from repetitors as r, salaries as s where r.id=s.repetitor_id and s.id='.$id);
		$r = $q->result_array();
		$repetitor_id = $r[0]['repetitor_id'];
		$repetitor_balance = $r[0]['balance'];
		$cost = $r[0]['cost'];
		if ($repetitor_balance >= $cost){
			$this->db->where('id', $repetitor_id);
			$this->db->update('repetitors', array('balance'=>($repetitor_balance - $cost)));
			$this->db->where('id', $id);
			$this->db->update('salaries', array('done_at'=>date('Y-m-d H:i:s', time())));
		}
		return 0;
	}

	public function chathistory()
	{
		$sel = 'select * from chats where (from_role=1 and to_role=2) or (from_role=2 and to_role=1) order by created_at DESC';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$chats = array();
		$i =0;
		foreach ($row as $r) {
			$chats[$i] = array(
				'id' 			=> $r['id'],
				'created_at' 	=> $r['created_at'],//$this->serverZone($r['created_at']),
				'message' 		=> $r['message'],
				'from_id' 		=> $r['from_id'],
				'from_role' 		=> $r['from_role'],
			);
			if ($r['from_role']==1){
				//from repetitor
				$q = $this->db->query('select first_name from repetitors where id='.$r['from_id']);
				$rep = $q->result_array();
				$sel = 'select first_name from students where id='.$r['to_id'];
				log_message('error', $sel);
				$q = $this->db->query($sel);
				$stu = $q->result_array();
				if (is_null($rep[0]['first_name'])){
					$chats[$i]['repetitor_name'] = 'Без имени';
				} else{
					$chats[$i]['repetitor_name'] = $rep[0]['first_name'];
				}
				if (is_null($stu[0]['first_name'])){
					$chats[$i]['student_name'] = 'Без имени';
				} else{
					$chats[$i]['student_name'] = $stu[0]['first_name'];
				}
				$chats[$i]['student_id'] = $r['to_id'];
				$chats[$i]['repetitor_id'] = $r['from_id'];
				$chats[$i]['chat_about'] = $chats[$i]['repetitor_name'];
			} else{
				//from student
				$q = $this->db->query('select first_name from repetitors where id='.$r['to_id']);
				$rep = $q->result_array();
				$q = $this->db->query('select first_name from students where id='.$r['from_id']);
				$stu = $q->result_array();
				if (is_null($rep[0]['first_name'])){
					$chats[$i]['repetitor_name'] = 'Без имени';
				} else{
					$chats[$i]['repetitor_name'] = $rep[0]['first_name'];
				}
				if (is_null($stu[0]['first_name'])){
					$chats[$i]['student_name'] = 'Без имени';
				} else{
					$chats[$i]['student_name'] = $stu[0]['first_name'];
				}
				$chats[$i]['student_id'] = $r['from_id'];
				$chats[$i]['repetitor_id'] = $r['to_id'];
				//$chats[$i]['chat_about'] = $chats[$i]['student_name'];
			}
			$i++;
		}
		return $chats;
	}

	public function delChat($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('chats');
		return 0;
	}

	public function getFeeds()
	{
		$q = $this->db->query('select r.id, r.rating, r.about, r.created_at, s.first_name as s_name, s.father_name as s_father, rep.first_name as r_name, rep.father_name as r_father, r.student_id, r.repetitor_id from ratings as r, students as s, repetitors as rep where r.student_id=s.id and r.repetitor_id=rep.id order by created_at DESC');
		$r = $q->result_array();
		for ($i=0; $i < count($r); $i++) {
			//$r[$i]['created_at'] = $this->serverZone($r[$i]['created_at']);
			if (is_null($r[$i]['s_name'])){
				$r[$i]['student'] = 'Без имени';
			} else{
				$r[$i]['student'] = $r[$i]['s_name'];
			}
			if (!is_null($r[$i]['s_father'])){
				$r[$i]['student'] .= ' '.$r[$i]['s_father'];
			}
			if (is_null($r[$i]['r_name'])){
				$r[$i]['repetitor'] = 'Без имени';
			} else{
				$r[$i]['repetitor'] = $r[$i]['r_name'];
			}
			if (!is_null($r[$i]['r_father'])){
				$r[$i]['repetitor'] .= ' '.$r[$i]['r_father'];
			}
		}
		return $r;
	}

	public function clearFeed($id)
	{
		$this->db->where('id', $id);
		$this->db->update('ratings', array('about'=>""));
		return 0;
	}

	public function getPreRepetitors()
	{
		$sel = 'select id, created_at, email from repetitors where status=0 order by created_at DESC, id DESC';
		$q = $this->db->query($sel);
		return $q->result_array();
	}

	public function newChats()
	{
		$sel = 'select count(id) as c from chats where to_role=3 and read_at is null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)>0){
			$new = $r[0]['c'];
		} else{
			$new = 0;
		}
		return $new;
	}

	public function getRequests()
	{
		$sel = 'select student_id,repetitor_id,created_at,pay_at,date_from from exercises where date_accept is null and student_id is not null order by created_at desc';
		$q = $this->db->query($sel);
		$req = $q->result_array();
		for ($i=0; $i < count($req); $i++) {
			$sel = 'select first_name from students where id='.$req[$i]['student_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			if (is_null($r[0]['first_name'])){
				$req[$i]['student_name'] = 'Без имени';
			} else{
				$req[$i]['student_name'] = $r[0]['first_name'];
			}
			$sel = 'select first_name, father_name from repetitors where id='.$req[$i]['repetitor_id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			if (is_null($r[0]['first_name'])){
				$req[$i]['repetitor_name'] = 'Без имени';
			} else{
				$req[$i]['repetitor_name'] = $r[0]['first_name'];
			}
			if (!is_null($r[0]['father_name'])){
				$req[$i]['repetitor_name'] .= ' '.$r[0]['father_name'];
			}
		}
		return $req;
	}

	public function getEvents($page, $type = null)
	{
		$num = 10;//записей на странице
		if (is_null($type)){
			$filter  = '';
		} else{
			$filter = ' where type="'.$type.'"';
		}
		$sel = 'select count(id) as c from events '.$filter;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$all = $r[0]['c'];//всего записей
		$pages = (int)ceil($all/$num); //всего страниц
		$sel = 'select * from events '.$filter.' order by created_at DESC limit '.(($page-1)*$num).','.$num;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$data = array(
			'page' => $page,
			'pages' => $pages,
			'events' => $r
		);
		return $data;
	}

	public function delEvent($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('events');
		return 0;
	}
}
