Filter for Bluedrake Database

Version History:
```php
// Script "Database 'xf_user_input_value' for particular user groups and "field_id"s
// Copyright (C) 2015  J. Baumann
// GNU License v3
//
// Customer: Bluedrake42, bluedrake42@gmail.com
// Author: J4nB1, janbumer1@gmail.com
// Reviewer: AlabasterSlim, marc.sutherland@gmail.com
// Date: 03.11.2015
//
// Version history:
// v0.1, 03.11.2015 22:04 GMT+1: First version of the script
// v0.2, 03.11.2015 23:11 GMT+1: Added option to choose if data should get serialized or not, changed output data to PR_names
// v0.3, 03.11.2015 23:43 GMT+1: Added filters for output data, updated header of script
// v0.4, 03.11.2015 23:59 GMT+1: Updated header of script
// v0.5, 04.11.2015 15:32 GMT+1: Updated variable names (standardization), altered some comments
// v0.6, 04.11.2015 16:16 GMT+1: Added function "sqlQuery", preparing for implementation of function
// v0.7, 05.11.2015 23:04 GMT+1: Implemented function "sqlQuery"
// v0.8, 06.11.2015 00:07 GMT+1: Changed output so that each name gets written to a new line, changed output method from "file_put_contents" to "fopen"/"fwrite"
// v1.0, 06.11.2015 00:29 GMT+1: Changed outcome to prefix 'reservedSlots.addNick "' and suffix '" . "\n"', Changed default filename to "reservedslots.con"
//
// Description: Filters data from the bluedrake42.com database (tables "xf_user" and "xf_user_field_value").
```
