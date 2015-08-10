# PHP CRUD
[![Latest Stable Version](https://poser.pugx.org/arjunkomath/crud/v/stable)](https://packagist.org/packages/arjunkomath/crud) [![Total Downloads](https://poser.pugx.org/arjunkomath/crud/downloads)](https://packagist.org/packages/arjunkomath/crud) [![Latest Unstable Version](https://poser.pugx.org/arjunkomath/crud/v/unstable)](https://packagist.org/packages/arjunkomath/crud)
[![Documentation Status](https://readthedocs.org/projects/phpcrud/badge/?version=latest)](https://readthedocs.org/projects/phpcrud/?badge=latest)

A simple generic PHP CRUD library
***
*Please note that this project is still in *beta*, it's not complete. There are more features to come.*

#Features
- Perform Create/Read/Update/Delete for you in just one line. :)
- In case, you don't feel like writing the views for all those, it will automatically generate the views also, and perform the corresponding operation.
- All views are generated using Bootstrap CSS.

#Requirements
- [j4mie/idiorm] (https://github.com/j4mie/idiorm)
- MySQL
- And of course, PHP

#Installation
##Packagist
This library is available through Packagist with the vendor and package identifier of `arjunkomath/crud`
Please see the Packagist [documentation](https://packagist.org/) for further information.

##Configuration
Configue idiorm, you can read more about it [here](http://idiorm.readthedocs.org/en/latest/configuration.html). You'll have to add the followng lines so that the CRUD class can access the database.

```php
<?php
ORM::configure('mysql:host=localhost;dbname=my_database');
ORM::configure('username', 'database_user');
ORM::configure('password', 'top_secret');
```

#Code
##Basic CRUD
Initialize the class
```php
$this->crud = new CRUD\CRUD();
```
It has three functions as follows:

###Read
This function can be used to read data, either the entire table data or you can read a row by its primary key.
To read an entire table:
```php
$result = $this->crud->read('table_name');
```
To read a row from a table by its primiary key:
```php
$result = $this->crud->read('table_name','id');
```
*All results are returned as array.*

###Save
This function can be used to save data to table, you can both create a new row or update an exsising entry.
To create an entry: Specify the table name and then pass an array of arguments in such a format that array key represents the field name and value represents the field value. It will return the newly inserted id of the row.
```php
$result = $this->crud->save('table_name', array ("column1" => "value1", "column2" => "value2"));
```
To update an entry identified by its primiary key: You pass an additional paremeter `id` that is the primary key value to the row to be updated. It will return the id of the row.
```php
$result = $this->crud->save('table_name', array ("column1" => "value1", "column2" => "value2"), 'id');
```

###Delete
This function can be used to delete an entry from table.
```php
$result = $this->crud->delete('table_name', 'id');
```
It will return `true`.

###Find
This function can be used to find a row by field name and value.
```php
$result = $this->crud->find('table_name', 'field_name', 'value');
```
It will return an array if the row exsists.

##CRUD and Views
Initialize the class
```php
$this->crud = new CRUD\Admin();
```
It has four functions as follows:

###Table
This function can be used to read data and display it in table format.
To display an entire table:
```php
$this->crud->table('table_name');
```
It has an optional paramater, that lets you hide any unwanted fields. You can pass an array of field names, and it will automatically skip those fields from the view.
```php
$this->crud->table('table_name', array ('field_name'));
```

###Read
This function can be used to read data from a row and display it in table format.
```php
$this->crud->table('table_name', 'id');
```
It has an optional paramater, that lets you hide any unwanted fields. You can pass an array of field names, and it will automatically skip those fields from the view.
```php
$this->crud->table('table_name', 'id', array ('field_name'));
```

###Create
This function can be used to input data from the user and save it to database, the CRUD class will automatically generate the views and save the entry to database.
```php
$this->crud->create('table_name');
```
It has an optional paramater, that lets you hide any unwanted fields. You can pass an array of field names, and it will automatically skip those fields from the view. Note that no default values can be passed to these fields as of now, although it will be implemented in future.
```php
$this->crud->create('table_name', array ('field_name'));
```

###Update
This function can be used to update an exsisting entry in the table, the CRUD class will automatically generate the views and update the entry in database.
```php
$this->crud->update('table_name', 'id');
```
It has an optional paramater, that lets you hide any unwanted fields. You can pass an array of field names, and it will automatically skip those fields from the view. Note that by default it will show the exsisting data saved in the row.
```php
$this->crud->create('table_name', 'id', array ('field_name'));
```

Thank you.
