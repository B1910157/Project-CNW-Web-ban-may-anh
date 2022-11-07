<?php

namespace CT275\Project;

class Category
{
	private $db;

	private $category_id = -1;
	public $category_name;
	
	private $errors = [];

	public function getId()
	{
		return $this->category_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	// public function fill(array $data)
	// {
	// 	if (isset($data['name'])) {
	// 		$this->name = trim($data['name']);
	// 	}

	// 	if (isset($data['price'])) {
	// 		$this->price = preg_replace('/\D+/', '', $data['price']);
	// 	}

	// 	if (isset($data['description'])) {
	// 		$this->description = trim($data['description']);
	// 	}

	// 	if (isset($data['category_name'])) {
	// 		$this->category_name = trim($data['category_name']);
	// 	}

	// 	if (isset($data['image'])) {
	// 		$this->image = trim($data['image']);
	// 	}

	// 	return $this;
	// }

//Lay du lieu Product tu CSDL
	public function fill(array $data)
	{
		if (isset($data['category_name'])) {
			$this->category_name = trim($data['category_name']);
		}
		return $this;
	}
	//Xuat loi
	public function getValidationErrors()
	{
		return $this->errors;
	}

	//Kiem tra loi
	public function validate()
	{
		if (!$this->category_name) {
			$this->errors['category_name'] = 'Tên Danh mục không hợp lệ.';
		}
		return empty($this->errors);
	}
	//??
	protected function fillFromDB(array $row)
	{
		[
		'category_id' => $this->category_id,
		'category_name' => $this->category_name
		] = $row;
		return $this;
	}
	//Hien thi tat ca danh muc
	public function all()
	{
		$categorys = [];
		$stmt = $this->db->prepare('select * from category');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$category = new Category($this->db);
			$category->fillFromDB($row);
			$categorys[] = $category;
		} return $categorys;
	} 



	//Lay danh muc dua vao id
	public function getCategory($category_id)
	{
		$stmt = $this->db->prepare('select * from category where category_id = :category_id');
		$stmt->execute(['category_id' => $category_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} return null;
	}

	public function getCategory2()
	{
		$categorys = [];
		$stmt = $this->db->prepare('select * from category, sanpham where category.category_id = :category_id');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$category = new Category($this->db);
			$category->fillFromDB($row);
			$categorys[] = $category;
		} return $categorys;
	} 

	//Cap nhat hoac insert vao table
	public function save()
	{
		$result = false;
		if ($this->category_id >= 0) {
			$stmt = $this->db->prepare('update category set category_name = :category_name
			                            where category_id = :category_id');
			$result = $stmt->execute([
			'category_name' => $this->category_name,
			'category_id' => $this->category_id]);
		
		} else {
			$stmt = $this->db->prepare(
			'insert into  category (category_name)
			values (:category_name)');
			$result = $stmt->execute([
			'category_name' => $this->category_name
			]);
			if ($result) {
				$this->category_id = $this->db->lastInsertId();
			}
			
			//move_uploaded_file : di chuyen tep da tai len den file moi vua tao
		} return $result;
	}

	//Tim san pham tren id
	public function find($category_id)
	{
		$stmt = $this->db->prepare('select * from category where category_id = :category_id');
		$stmt->execute(['category_id' => $category_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		} else return null;
	} 

	//Cap nhat san pham
	public function update(array $data)
	{
		//basename : tra ve ten tep tu mot duong dan
		$this->fill($data);
		if ($this->validate()) {
			return $this->save();
		} return false; 
	}
	//Xoa danh muuic trong gio hang
	public function delete($category_id)
	{
		$stmt = $this->db->prepare('delete from category where category.category_id = :category_id');
		return $stmt->execute(['category_id' => $category_id]);
	}

	public function delete2()
	{
		$flag = 0;
		$checkproduct = $this->db->prepare('select * from sanpham');
		$checkproduct->execute();
		foreach ($checkproduct as $category) {
			if ($category['category_id'] == $this->category_id) {
				$flag  = 1;
			} else { 
				$flag  = 0;
			}
		}
		if ($flag == 0) {
			$stmt = $this->db->prepare('delete from category where category.category_id = :category_id');
			return $stmt->execute(['category_id' => $this->category_id]);
		} else return null;
		
	}


}
