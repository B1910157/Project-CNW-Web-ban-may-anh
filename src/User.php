<?php

namespace CT275\Project;

class User
{
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

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

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
		}
		if (!$this->diachi) {
			$this->errors['diachi'] = 'Lỗi địa chỉ.';
		}

		return empty($this->errors);
	}
	public function all()
	{
		$users = [];
		$stmt = $this->db->prepare('select * from nguoidung');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$user = new User($this->db);
			$user->fillFromDB($row);
			$users[] = $user;
		}
		return $users;
	}

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

	protected function fillFromDB(array $row)
	{
		[
			'id' => $this->id,
			'fullname' => $this->fullname,
			'username' => $this->username,
			'password' => $this->password,
			'diachi' => $this->diachi,
			'admin' => $this->admin,
			'created_day' => $this->created_day,
			'updated_day' => $this->updated_day
		] = $row;
		return $this;
	}
	public function save()
	{
		$result = false;
		if ($this->id < 0) {
			$stmt = $this->db->prepare(
				'insert into nguoidung (admin, fullname, username, password,diachi, created_day, updated_day)
			values ("0", :fullname, :username, :password, :diachi, now(), now())'
			);
			$result = $stmt->execute([
				'fullname' => $this->fullname,
				'username' => $this->username,
				'password' => $this->password,
				'diachi' => $this->diachi
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		}
		return $result;
	}

	public function find($id)
	{
		$stmt = $this->db->prepare('select * from nguoidung where id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
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
	
	//Kiem tra dang nhap (Ket qua tra ve 1 dong thi tai khoan co ton tai va cho phep dang nhap)
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
	//Kiem tra dang nhap (Lay username va password sau khi dang nhap thanh cong)
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
