<?php

namespace CT275\Project;

class Order
{
	private $db;

	private $id = -1;
	public $userID;
	public $cart_id;
	public $status;
	public $total_price;
	public $created_day;
	private $errors = [];

	public function getId()
	{
		return $this->id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function insertOrder($cart_id){
		$total_price = 0;
		$result = $this->db->prepare('select gh.*,ctgh.quantity,sp.price from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id inner join sanpham sp on ctgh.product_id = sp.id where gh.cart_id = :cart_id');
		$result->execute(['cart_id' => $cart_id]);
		// $cart = $result->fetch();
		foreach ($result as $cart) {
			$total_price = $total_price + $cart['quantity']*$cart['price'];
			// echo $total_price;
			// print_r($cart);
		}
		$stmt = $this->db->prepare(
		'insert into donhang (user_id, cart_id, total_price, status, created_day)
		values (:user_id, :cart_id, :total_price, 0, now())');
		$order = $stmt->execute([
		'user_id' => $cart['user_id'],
		'cart_id' => $cart['cart_id'],
		'total_price' => $total_price
		]);
		$sql = $this->db->prepare('delete from chitietgiohang where cart_id = :cart_id');
		$delcart = $sql->execute(['cart_id' => $cart_id]);
		$sql = $this->db->prepare('delete from giohang where cart_id = :cart_id');
		$delcart2 = $sql->execute(['cart_id' => $cart_id]);
		if ($order) {
			$this->id = $this->db->lastInsertId();
		}
	return $order;
	}
	public function getOrders($id){
		$orders = [];
		$stmt = $this->db->prepare('select * from donhang where user_id = :id');
		$stmt->execute(['id' => $id]);
		while ($row = $stmt->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDB($row);
			$orders[] = $order;
		} return $orders;
	}

	public function getAll(){
		$orders = [];
		$stmt = $this->db->prepare('select * from donhang order by order_id desc');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDB($row);
			$orders[] = $order;
		} return $orders;
	}

	public function update($id){
		$stmt = $this->db->prepare('update donhang set status = 1 where order_id = :id');
			$result = $stmt->execute(['id' => $id]);
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

	// public function getValidationErrors()
	// {
	// 	return $this->errors;
	// }

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
	// public function all()
	// {
	// 	$carts = [];
	// 	$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id');
	// 	$stmt->execute();
	// 	while ($row = $stmt->fetch()) {
	// 		$cart = new Cart($this->db);
	// 		$cart->fillFromDB($row);
	// 		$carts[] = $cart;
	// 	} return $carts;
	// } 
	
	protected function fillFromDB(array $row)
	{
		[
		'order_id' => $this->id,
		'user_id' => $this->userID,
		'cart_id' => $this->cart_id,
		'status' => $this->status,
		'total_price' => $this->total_price,
		'created_day' => $this->created_day
		] = $row;
		return $this;
	}
 
	// public function save()
	// {
	// 	$result = false;
	// 	if ($this->id >= 0) {
	// 		$stmt = $this->db->prepare('update chitietgiohang set product_id = :product_id,
	// 		quantity = :quantity, updated_day = now()
	// 		where cart_id = :cart_id');
	// 		$result = $stmt->execute([
	// 		'product_id' => $this->product_id,
	// 		'quantity' => $this->quantity,
	// 		'cart_id' => $this->id]);
	// 	} else {
	// 		$stmt = $this->db->prepare(
	// 		'insert into chitietgiohang (product_id, quantity, added_day, updated_day)
	// 		values (:product_id, :quantity, now(), now())');
	// 		$result = $stmt->execute([
	// 		'product_id' => $this->product_id,
	// 		'quantity' => $this->quantity]);
	// 		if ($result) {
	// 			$this->id = $this->db->lastInsertId();
	// 		}
	// 	} return $result;
	// }

	public function find($id)
	{
		$stmt = $this->db->prepare('select * from donhang where user_id = :id');
		return $stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;

	} 
	// // public function update(array $data)
	// // {
	// // 	$this->fill($data);
	// // 	if ($this->validate()) {
	// // 		return $this->save();
	// // 	} return false;
	// // }

	// public function delete()
	// {
	// 	$stmt = $this->db->prepare('delete from nguoidung where id = :id');
	// 	return $stmt->execute(['id' => $this->id]);
	// }
}
