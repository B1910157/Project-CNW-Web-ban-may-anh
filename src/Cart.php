<?php

namespace CT275\Project;

class Cart
{
	private $db;

	private $id = -1;
	public $userID; //khoa ngoai
	public $product_id; //khoa ngoai
	public $quantity;
	public $added_day;
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

	// public function fill(array $data)
	// {
	// 	if (isset($data['userID'])) {
	// 		$this->userID = trim($data['userID']);
	// 	}

	// 	if (isset($data['productID'])) {
	// 		$this->products['product_id'] = trim($data['productID']);
	// 	}

	// 	if (isset($data['quantity'])) {
	// 		$this->quantity = trim($data['quantity']);
	// 	}

	// 	return $this;
	// }

	public function getValidationErrors()
	{
		return $this->errors;
	}

	// public function validate()
	// {
	// 	if (!$this->fullname) {
	// 		$this->errors['fullname'] = 'Tên người dùng không hợp lệ.';
	// 	}

	// 	if (!$this->username) {
	// 		$this->errors['username'] = 'Tên đăng nhập không hợp lệ.';
	// 	} elseif (strlen($this->username) < 8) {
	// 		$this->errors['username'] = 'Tên đăng nhập phải hơn 8 ký tự.';
	// 	}

	// 	if (strlen($this->password) < 8) {
	// 		$this->errors['password'] = 'Mật khẩu phải hơn 8 ký tự.';
	// 	}

	// 	return empty($this->errors);
	// }
	public function all()
	{
		$carts = [];
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$cart = new Cart($this->db);
			$cart->fillFromDB($row);
			$carts[] = $cart;
		} return $carts;
	} 
	public function getCart($id) {
		$carts = [];
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.user_id = :id');
		$stmt->execute(['id' => $id]);
		while ($row = $stmt->fetch()) {
			$cart = new Cart($this->db);
			$cart->fillFromDB($row);
			$carts[] = $cart;
		} return $carts;
	}

	public function getCart2($id) {
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.user_id = :id');
		$stmt->execute(['id' => $id]);
		return $stmt->fetch();
	}

	public function getCart3($id,$product_id) {
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.user_id = :id and ctgh.product_id = :product_id');
		$stmt->execute(['id' => $id, 'product_id' => $product_id]);
		 if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}

	// public function getUser()
	// {
	// 	$users = [];
	// 	$stmt = $this->db->prepare('select * from nguoidung where admin = 0');
	// 	$stmt->execute();
	// 	while ($row = $stmt->fetch()) {
	// 		$user = new User($this->db);
	// 		$user->fillFromDB($row);
	// 		$users[] = $user;
	// 	} return $users;
	// } 

	protected function fillFromDB(array $row)
	{
		[
		'cart_id' => $this->id,
		'user_id' => $this->userID,
		'added_day' => $this->added_day,
		'updated_day' => $this->updated_day,
		'product_id' => $this->product_id,
		'quantity' => $this->quantity
		] = $row;
		return $this;
	}
 
	public function save()
	{
		$result = false;
		if ($this->id >= 0) {
			$stmt = $this->db->prepare('update chitietgiohang set product_id = :product_id,
			quantity = :quantity, updated_day = now()
			where cart_id = :cart_id');
			$result = $stmt->execute([
			'product_id' => $this->product_id,
			'quantity' => $this->quantity,
			'cart_id' => $this->id]);
		} else {
			$stmt = $this->db->prepare(
			'insert into chitietgiohang (product_id, quantity, added_day, updated_day)
			values (:product_id, :quantity, now(), now())');
			$result = $stmt->execute([
			'product_id' => $this->product_id,
			'quantity' => $this->quantity]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		} return $result;
	}

	// public function find($id)
	// {
	// 	$stmt = $this->db->prepare('select * from nguoidung where id = :id');
	// 	$stmt->execute(['id' => $id]);
	// 	if ($row = $stmt->fetch()) {
	// 		$this->fillFromDB($row);
	// 		return $this;
	// 	} return null;
	// } 
	// public function update(array $data)
	// {
	// 	$this->fill($data);
	// 	if ($this->validate()) {
	// 		return $this->save();
	// 	} return false;
	// }

	// public function delete()
	// {
	// 	$stmt = $this->db->prepare('delete from nguoidung where id = :id');
	// 	return $stmt->execute(['id' => $this->id]);
	// }

	public function delete_cart($cart_id,$product_id)
	{
		$stmt = $this->db->prepare('delete from chitietgiohang where cart_id = :cart_id and product_id = :product_id');
		return $stmt->execute(['cart_id' => $cart_id,'product_id' => $product_id]);
	}

	
	public function find($id)
	{
		$sql = "select * from giohang where user_id = :id";
		$query = $this->db->prepare($sql);
		$query->execute(['id' => $id]);
		return $query->fetch();
	} 

	public function update_cart($id,$quantity,$product_id) {
		$sql = "update chitietgiohang set quantity = :quantity where (cart_id = :cart_id and product_id = :product_id)";
    	$query = $this->db->prepare($sql);
    	return $query->execute([
    		'cart_id' => $id,
        	'quantity' => $quantity,
        	'product_id' => $product_id
    	]);
	}

	public function insert_cart($id,$product_id,$quantity) {
		$sql = "insert into chitietgiohang (cart_id, product_id, quantity) values (:cart_id, :product_id, :quantity)";
    	$query = $this->db->prepare($sql);
    	$query->execute([
        	'cart_id' => $id,
        	'product_id' => $product_id,
        	'quantity' => $quantity
    	]);
	}

	public function addNewCart($user_id,$cart_id,$product_id,$quantity) {
		$sql = "insert into giohang (user_id, added_day, updated_day) values (:user_id, now(), now())";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	        'user_id' => $user_id
	    ]);
	    $sql = "select * from giohang order by cart_id desc limit 0,1";
	    $query = $this->db->prepare($sql);
	    $query->execute();
	    // $result = $query->fetch();
	    $sql = "insert into chitietgiohang (cart_id, product_id, quantity) values (:cart_id, :product_id, :quantity)";
	    $query = $this->db->prepare($sql);
	    $query->execute([
	    	'cart_id' => $cart_id,
	       	'product_id' => $product_id,
	       	'quantity' => $quantity
	    ]);
	}
}
