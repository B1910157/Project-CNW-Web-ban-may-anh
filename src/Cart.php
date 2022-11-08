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

	public function fill(array $data)
	{
		if (isset($data['userID'])) {
			$this->userID = trim($data['userID']);
		}

		if (isset($data['productID'])) {
			$this->product_id = trim($data['productID']);
		}

		if (isset($data['quantity'])) {
			$this->quantity = trim($data['quantity']);
		}

		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->userID) {
			$this->errors['userID'] = 'ID người dùng không hợp lệ.';
		}

		if (!$this->product_id) {
			$this->errors['product_id'] = 'ID sản phẩm không hợp lệ.';
		}

		if (!$this->quantity) {
			$this->errors['quantity'] = 'Số lượng không hợp lệ.';
		}

		return empty($this->errors);
	}
	public function all()
	{
		$carts = [];
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$cart = new Cart($this->db);
			$cart->fillFromDB($row);
			$carts[] = $cart;
		}
		return $carts;
	}
	
//Dung de them san pham vao gio hang cua nguoi dung
	public function getCart3($id, $product_id)
	{
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.user_id = :id and ctgh.product_id = :product_id');
		$stmt->execute(['id' => $id, 'product_id' => $product_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

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
				'cart_id' => $this->id
			]);
		} else {
			$stmt = $this->db->prepare(
				'insert into chitietgiohang (product_id, quantity, added_day, updated_day)
			values (:product_id, :quantity, now(), now())'
			);
			$result = $stmt->execute([
				'product_id' => $this->product_id,
				'quantity' => $this->quantity
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		}
		return $result;
	}
	//Tim kim dua tren id user
	public function find($id)
	{
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.user_id = :id');
		$stmt->execute(['id' => $id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	//Tim kiem don hang????
	public function find2($cart_id, $product_id)
	{
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.cart_id = :id and ctgh.product_id = :product_id');
		$stmt->execute(['id' => $cart_id, 'product_id' => $product_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}
	///Tim kim dua tren id cua gio hang
	public function findCart($id)
	{
		$stmt = $this->db->prepare('select gh.*,ctgh.product_id,ctgh.quantity from giohang gh inner join chitietgiohang ctgh on gh.cart_id = ctgh.cart_id where gh.cart_id = :id');
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
		$stmt = $this->db->prepare('delete from giohang where id = :id');
		return $stmt->execute(['id' => $this->id]);
	}

	//Xoa san pham khoi gio hang
	public function delete_detail()
	{
		$stmt = $this->db->prepare('delete from chitietgiohang where cart_id = :cart_id and product_id = :product_id');
		return $stmt->execute([
			'cart_id' => $this->getId(),
			'product_id' => $this->product_id
		]);
	}

	public function delete_cart()
	{
		$stmt = $this->db->prepare('delete from chitietgiohang where cart_id =: cart_id and product_id =:product_id');
		return $stmt->execute(['cart_id' => $this->cart_id, 'product_id' => $this->product_id]);
	}

	public function update_cart(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->update_cart2();
		}
		return false;
	}


	//Cap nhan lai gio hang
	public function update_cart2()
	{
		$sql = "update chitietgiohang set quantity = :quantity where (cart_id = :cart_id and product_id = :product_id)";
		$query = $this->db->prepare($sql);
		$result = $query->execute([
			'cart_id' => $this->getId(),
			'quantity' => $this->quantity,
			'product_id' => $this->product_id
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}

	public function insert_cart(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->insert_cart2();
		}
		return false;
	}

	//Them san pham vao gio hang
	public function insert_cart2()
	{
		$sql = "insert into chitietgiohang (cart_id, product_id, quantity) values (:cart_id, :product_id, :quantity)";
		$query = $this->db->prepare($sql);
		$result = $query->execute([
			'cart_id' => $this->getId(),
			'product_id' => $this->product_id,
			'quantity' => $this->quantity
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}



	public function addNewCart(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->addNewCart2();
		}
		return false;
	}

	////////Tao ra  1 gio hang cho user, moi user se co 1 gio hang khi dang nhap
	public function addNewCart2()
	{
		$sql = "insert into giohang (user_id, added_day, updated_day) values (:user_id, now(), now())";
		$query = $this->db->prepare($sql);
		// echo $this->$userID;
		$result1 = $query->execute([
			'user_id' => $this->userID
		]);
		if ($result1) {
			$this->id = $this->db->lastInsertId();
		}
		$sql = "select * from giohang order by cart_id desc limit 0,1";
		$query = $this->db->prepare($sql);
		$result = $query->execute();
		// echo $this->getId();
		// $result = $query->fetch();
		$sql = "insert into chitietgiohang (cart_id, product_id, quantity) values (:cart_id, :product_id, :quantity)";
		$query = $this->db->prepare($sql);
		$result2 = $query->execute([
			'cart_id' => $this->getId(),
			'product_id' => $this->product_id,
			'quantity' => $this->quantity
		]);
		if ($result) {
			$this->id = $this->db->lastInsertId();
		}
		return $result;
	}
}
