##Developers
Jill Kuchman

##Date
March 27 2015

##Description
This Shoe Store app will allow a User to create a list of shoe stores and the brands of shoes they carry.


##Use and Editing
To use the app, download the source code and run it in on your php server.
Run your PHP server from the <strong>web</strong> folder.
You will need to create a psql database with the following tables and attributes:
<br/>
<ol>
<li>CREATE DATABASE shoes;</li>
<li>\c shoes;</li>
<li>CREATE TABLE stores (id serial PRIMARY KEY, name varchar);</li>
<li>CREATE TABLE brands (id serial PRIMARY KEY, title varchar);</li>
<li>CREATE TABLE brands_stores (id serial PRIMARY KEY, brands_id int, stores_id int);</li>
<li>CREATE DATABASE shoes_test WITH TEMPLATE shoes;</li>
</ol>
<br/>

To edit the app, download the source code and open it in your text editor. <br />
    *Note: If you are copying any of the code to your own directories, you may need to install Composer
    in your root directory*

##Copyright (c) 2015 Jill Kuchman
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
