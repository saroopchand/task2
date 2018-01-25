Task 2:

Create a Magento Shell script that takes a file path and name as parameter. The file is a
simple text file that contains a list of comma separated product ids. For each product in that
list check the following properties and assign the product id to separate lists, finally print the
lists.

- Status: product enabled/disabled
- Images: count of images
- Categories associated: count of categories
The shell script should be invoked like:
php shell/task.php --file /path/to/the/file.txt
The file.txt should look like this (Feel free to use different product ids as needed):
10,2055,900,544,2266,45555
The output of the script should be:
Array
(
    [status] => Array
        (
        [enabled] => 10,2055,900
        [disabled] => 544,2266,45555
        )
)
// the key is the product id and the value is the number of images
Array
(
    [images] => Array
    (
        [10] => 2
        [2055] => 0
        [900] => 5
    )
)
// the key is the product id and the value is the number of categories where the product is
listedArray
(
    [categories] => Array
    (
        [10] => 2
        [2055] => 0
        [900] => 5
    )
)