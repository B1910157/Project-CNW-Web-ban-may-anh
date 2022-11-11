<?php 
namespace CT275\Project;
class User {

	private $db;
	private $id = -1;
	public $admin;
	public $fullname;
	public $username;
	public $password;
	public $diachi;
	public $created_day;
	public $updated_day;
	private $errors = [];

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function getId()
	{
		return $this->id;
	}

	//Them du lieu vao csdl tu input cua nguoi dung nhap vao
	public function fill(array $data)
	{
		if (isset($data['fullname'])) {
			$this->fullname = trim($data['fullname']);
		}
		if (isset($data['username'])) {
			$this->username = trim($data['username']);
		}
		if (isset($data['password'])) {
			$this->password = trim($data['password']);
		}
		if (isset($data['diachi'])) {
			$this->diachi = trim($data['diachi']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->fullname) {
			$this->errors['fullname'] = 'Tên người dùng không hợp lệ.';
		}

		if (!$this->username) {
			$this->errors['username'] = 'Tên đăng nhập không hợp lệ.';
		} elseif (strlen($this->username) < 2) {
			$this->errors['username'] = 'Tên đăng nhập phải hơn 2 ký tự.';
		}

		if (strlen($this->password) < 5) {
			$this->errors['password'] = 'Mật khẩu phải hơn 5 ký tự.';
		}elseif (!$this->password) {
			$this->errors['password'] = 'Mật khẩu không hợp lệ.';
		}

		if (!$this->diachi) {
			$this->errors['diachi'] = 'Lỗi địa chỉ.';
		}

		return empty($this->errors);
	}

	//Lay tat ca du lieu tu bang nguoidung
	public function all()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from nguoidung');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		} return $users;
	}

	//Lay nguoi dung
	public function getUser()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from nguoidung where admin = 0');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		}
		return $users;
	}

	//Lay du lieu tu csdl
	protected function fillFromDB(array $row)
	{
		[
		'id' => $this->id,
		'admin' => $this->admin,
		'fullname' => $this->fullname,
		'username' => $this->username,
		'password' => $this->password,
		'diachi' => $this->diachi,
		'created_day' => $this->created_day,
		'updated_day' => $this->updated_day
		] = $row;
		return $this;
	} 
//Tim nguoi dung
	public function find($id)
	{
		$stmt = $this->db->prepare('select * from nguoidung where id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}

	//Tim kiem username, kiem tra neu co ton tai username trong csdl thi thông bao 
	// da ton tai va yeu cau chon 1 username khac de dang nhap
	public function findUsername($var)
	{
		$stmt = $this->db->prepare('select * from nguoidung where binary username = :var');
		$stmt->execute(['var' => $var]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}



//
//Cap nhat hoac them du lieu (Neu id ton tai thi cap nhat nguoi dung dua tren id,
// Neu id khong ton tai <= 0 thi them du lieu moi)
	public function save()
	{
		$result = false;
		if ($this->id > 0) {
			$stmt = $this->db->prepare('update nguoidung set fullname = :fullname,
			username = :username, password = :password, diachi = :diachi, updated_day = now()
			where id = :id');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'password' => $this->password,
			'diachi' => $this->diachi,
			'id' => $this->id]);
		} else {
			$stmt = $this->db->prepare(
			'insert into nguoidung (fullname, username, password, diachi, created_day, updated_day)
			values (:fullname, :username, :password, :diachi, now(), now())');
			$result = $stmt->execute([
			'fullname' => $this->fullname,
			'username' => $this->username,
			'password' => $this->password,
			'diachi' => $this->diachi]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} return $result;
	}
//
//Cap nhat hoac them du lieu du lieu
	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		}
		return false;
	}

	public function delete()
	{
		$stmt = $this->db->prepare('delete from nguoidung where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}
	//Kiem tra dang nhap
	//Ham tra ve so dong sau khi thuc hien cau lenh 
	public function checkpoint($username,$password){
		$sql = "SELECT * from nguoidung where username =:u and password =:p";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'u' => $username,
	        'p' => $password
	    ]);
	    return $query->rowCount();
	    //  return  $query->fetch();
	}
	//Kiem tra dang nhap
	//Ham tra ve mang du lieu username va password
	public function checkpoint2($username,$password){
		$sql = "SELECT * from nguoidung where username =:u and password =:p";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'u' => $username,
	        'p' => $password
	    ]);
	    // return $row = $query->rowCount();
	     return $query->fetch();
	}
}
 

 ?>