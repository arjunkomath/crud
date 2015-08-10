# PHP CRUD
[![Latest Stable Version](https://poser.pugx.org/arjunkomath/crud/v/stable)](https://packagist.org/packages/arjunkomath/crud) [![Total Downloads](https://poser.pugx.org/arjunkomath/crud/downloads)](https://packagist.org/packages/arjunkomath/crud) [![Latest Unstable Version](https://poser.pugx.org/arjunkomath/crud/v/unstable)](https://packagist.org/packages/arjunkomath/crud) [![License](https://poser.pugx.org/arjunkomath/crud/license)](https://packagist.org/packages/arjunkomath/crud)

A simple generic PHP CRUD library
***
*Please note that this project is still in beta, it's not complete. There are more features to come.*

##Features
- Perform Create/Read/Update/Delete for you in just one line. :)
- In case, you don't feel like writing the views for all those, it will automatically generate the views also, and perform the corresponding operation.
- All views are generated using Bootstrap CSS.

##Requirements
- [j4mie/idiorm] (https://github.com/j4mie/idiorm)
- MySQL
- And of course, PHP

##Installation
###Packagist
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

##Basic CRUD Class
Initialize the class
```php
$this->crud = new CRUD\Admin();
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
