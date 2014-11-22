/*        Cân bằng phương trình hóa học      */
/*        Hoạt động tốt trên FireFox, Chrome     */
/*
* Các quy ước chung khi sử dụng Script như sau:
*    - Do các chữ số nhỏ không thể thao tác được nên bạn có thể 
*      viết ngay bên cạnh.
*      Ví dụ: CO2 - Cacbondioxit
*             H2O - Nước 
*    - Các công thức của hợp chất hữu cơ viết ở dạng công thức phân tử 
*      Ví dụ: CH2=CH2  ---> C2H4
*    - Để tránh nhầm lẫn có thể viết Cách nhanh
*      Ví dụ: C O 2    ---> CO2
*    - Viết đúng các kí hiệu hóa học, chú ý chữ hoa và chữ thường.
*      Ví dụ: hcl  ---> Sai      ====> HCl --->  Đúng
*/

/*
* @ (c) 2012 yplitgroup
* @ Email: duyet2000@gmail.com
* @ Facebook: https://facebook.com/yplitgroup
*/

// Sent request
// AJAX Require ( Not use IE )
function createObject()
{
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer")
	{
		request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}
	else
	{
		request_type = new XMLHttpRequest();
	}
	return request_type;
}
var http = createObject();
var check = 0;
function save_query()
{
	var phuongtrinh = encodeURIComponent(document.getElementById('input').value);
	var check = Math.random();
	var url = config_save_path+'?check='+check + '&query=' + phuongtrinh;
	if( showlog == true ) { url += '&showlog' }
	http.open('GET', url, true);
	//http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.onreadystatechange = save_query_show;
	http.send(null);
}

function save_query_show()
{
	//if(http.readyState == 4) alert('Ok');
}

/******************/
/* Main Function */
function Canbang()
	{
		// Xoa toan bo Output
		setMessage("");
		var balancedElem = document.getElementById("kq_canbang");
		var codeOutElem = document.getElementById("kq_codeOutput");
		removeAllChildren(balancedElem);
		removeAllChildren(codeOutElem);
		codeOutElem.appendChild(document.createTextNode(NBSP));
		// Phân tích
		var eqn;
		try
		{
			var eqn = parse();
		}
		catch (e)
		{
			if (typeof(e) == "string")
			{
				setMessage(_syntax_error + e);
			}
			else if ("start" in e && "end" in e) 
			{
				setMessage(_syntax_error + ': ' + e.message);
			
				var input = document.getElementById("input").value;
				var start = e.start;
				var end = e.end;
				while (start < input.length && start < end && input.charAt(start) == " ") start++;  // Adjust to eliminate white space
				while (end >= 1 && start < end && input.charAt(end - 1) == " ") end--;              // Adjust to eliminate white space
			
				removeAllChildren(codeOutElem);
				codeOutElem.appendChild(document.createTextNode(input.substring(0, start)));
				var highlight = document.createElement("u");
				highlight.appendChild(document.createTextNode(input.substring(start, end)));
				codeOutElem.appendChild(highlight);
				codeOutElem.appendChild(document.createTextNode(input.substring(end, input.length)));
			}
			else if ("start" in e)
			{
				setMessage(_syntax_error + ': ' + e.message);
				var input = document.getElementById("input").value;
				var start = e.start;
				removeAllChildren(codeOutElem);
				codeOutElem.appendChild(document.createTextNode(input.substring(0, start)));
				var highlight = document.createElement("u");
				if (start != input.length)
				{
					highlight.appendChild(document.createTextNode(input.substring(start, start + 1)));
					codeOutElem.appendChild(highlight);
					codeOutElem.appendChild(document.createTextNode(input.substring(start + 1, input.length)));
				}
				else
				{
					highlight.appendChild(document.createTextNode(NBSP));
					codeOutElem.appendChild(highlight);
				}
			}
			else
			{
				setMessage("Assertion error");
			}
			return; // Thoat
		}
	
	try
	{
		var matrix = buildMatrix(eqn);                // Lập ma trận 
		solve(matrix);                               
		var coefs = extractCoefficients(matrix);      
		checkAnswer(eqn, coefs);                       
		balancedElem.appendChild(eqn.toHtml(coefs));  // Hiển thị kết quả cân bằng
		$('#clear').fadeIn(300); // Show Clear
		if( is_query == true ){
			save_query();
		}
	}
	catch (e)
	{
		setMessage(e.toString());
	}
} // End function

function show(str)
{ // Dành cho Ví dụ
	if( str == '' ) 
	{
		return false;
	}
	else
	{
		document.getElementById("input").value = str;
		Canbang();
	}
}

function parse(  ) // Phân tích phương trình hh
{
	var input = document.getElementById("input").value; // Get dữ liệu từ form
	var tokenizer = new Tokenizer(input);
	return parseEquation(tokenizer);
}


function buildMatrix( eald ) // Ma trận
{
	var elems = eald.getElements();
	var rows = elems.length + 1;
	var cols = eald.getLeftSide().length + eald.getRightSide().length + 1;
	var matrix = new Matrix(rows, cols);
	for (var i = 0; i < elems.length; i++)
	{
		var j = 0;
		for (var k = 0, lhs = eald.getLeftSide() ; k < lhs.length; j++, k++)
			matrix.set(i, j,  lhs[k].countElement(elems[i]));
		for (var k = 0, rhs = eald.getRightSide(); k < rhs.length; j++, k++)
			matrix.set(i, j, -rhs[k].countElement(elems[i]));
	}
	
	return matrix;
}


function solve(matrix) // Giải ma trận
{
	matrix.gaussJordanEliminate();
	
	// Tim
	var i;
	for (i = 0; i < matrix.rowCount() - 1; i++)
	{
		if (countNonzeroCoeffs(matrix, i) > 1)
			break;
	}
	if (i == matrix.rowCount() - 1)
		throw _error_khong_the_can_bang;
	
	matrix.set(matrix.rowCount() - 1, i, 1);
	matrix.set(matrix.rowCount() - 1, matrix.columnCount() - 1, 1);
	
	matrix.gaussJordanEliminate();
}


function countNonzeroCoeffs(matrix, row)
{
	var count = 0;
	for (var i = 0; i < matrix.columnCount(); i++) {
		if (matrix.get(row, i) != 0)
			count++;
	}
	return count;
}


// Những hàm trong Javascript 1.6, Fix lỗi trong IE
function indexOf(array, item) {
	for (var i = 0; i < array.length; i++) {
		if (array[i] == item)
			return i;
	}
	return -1;
}


function setMessage(str) {
	var messageElem = document.getElementById("kq_message");
	removeAllChildren(messageElem);
	messageElem.appendChild(document.createTextNode(str));
}


function removeAllChildren(node) {
	while (node.childNodes.length > 0)
		node.removeChild(node.firstChild);
}
/**/

function extractCoefficients(matrix) 
{
	var rows = matrix.rowCount();
	var cols = matrix.columnCount();
	
	if (cols - 1 > rows || matrix.get(cols - 2, cols - 2) == 0)
		throw _no_unique_solution;
	
	var lcm = 1;
	for (var i = 0; i < cols - 1; i++)
		lcm = checkedMultiply(lcm / gcd(lcm, matrix.get(i, i)), matrix.get(i, i));
	
	var coefs = [];
	var allzero = true;
	for (var i = 0; i < cols - 1; i++) {
		var coef = checkedMultiply(lcm / matrix.get(i, i), matrix.get(i, cols - 1));
		coefs.push(coef);
		allzero &= coef == 0;
	}
	if (allzero)
		throw "Assertion error: All zero solution";
	return coefs;
}


// Mot vai loi thuong thay
function checkAnswer(eqn, coefs) {
	if (coefs.length != eqn.getLeftSide().length + eqn.getRightSide().length)
		throw _error_pt_length;

	var allzero = true;
	for (var i = 0; i < coefs.length; i++) {
		var coef = coefs[i];
		if (typeof coef != "number" || isNaN(coef) || Math.floor(coef) != coef)
			throw _error_not_integer;
		allzero &= coef == 0;
	}
	if (allzero)
		throw "Lỗi phương trình: Solution of all zeros";
	
	var elems = eqn.getElements();
	for (var i = 0; i < elems.length; i++) {
		var sum = 0;
		var j = 0;
		for (var k = 0, lhs = eqn.getLeftSide() ; k < lhs.length; j++, k++)
			sum = checkedAdd(sum, checkedMultiply(lhs[k].countElement(elems[i]),  coefs[j]));
		for (var k = 0, rhs = eqn.getRightSide(); k < rhs.length; j++, k++)
			sum = checkedAdd(sum, checkedMultiply(rhs[k].countElement(elems[i]), -coefs[j]));
		if (sum != 0)
			throw _error_pt_error;
	}
}


// H2 + O2 -> H2O.
function Equation(lhs, rhs)
{
	lhs = lhs.slice(0);  // Xác định các biến
	rhs = rhs.slice(0);  // Xác định các biến
	
	this.getLeftSide  = function() 
	{
		return lhs.slice(0); 
	}  // Xác định các biến
	this.getRightSide = function() 
	{
		return rhs.slice(0);
	}  // Xác định các biến
	
	this.getElements = function() {
		var result = new Set();
		for (var i = 0; i < lhs.length; i++)
			lhs[i].getElements(result);
		for (var i = 0; i < rhs.length; i++)
			rhs[i].getElements(result);
		return result.toArray();
	}
	
	this.toHtml = function(coefs) {
		if (coefs !== undefined && coefs.length != lhs.length + rhs.length)
			throw "Mismatched number of coefficients";
		var node = document.createElement("span");
		
		var initial = true;
		for (var i = 0; i < lhs.length; i++) {
			var coef = coefs !== undefined ? coefs[i] : 1;
			if (coef != 0) {
			if (initial) initial = false;
			else node.appendChild(document.createTextNode(" + "));
				if (coef != 1)
					node.appendChild(document.createTextNode(coef.toString().replace(/-/, MINUS)));
				node.appendChild(lhs[i].toHtml());
			}
		}
		
		node.appendChild(document.createTextNode(" \u2192 "));
		
		initial = true;
		for (var i = 0; i < rhs.length; i++) {
			var coef = coefs !== undefined ? coefs[lhs.length + i] : 1;
			if (coef != 0) {
			if (initial) initial = false;
			else node.appendChild(document.createTextNode(" + "));
				if (coef != 1)
					node.appendChild(document.createTextNode(coef.toString().replace(/-/, MINUS)));
				node.appendChild(rhs[i].toHtml());
			}
		}
		return node;
	}
}


// Cân bằng ion
// Ví dụ: H3O^+, or e^-.
function Term(items, charge) {
	if (items.length == 0 && charge != -1)
		throw _error_invalid_term;
	items = items.slice(0);  // Defensive copy
	
	this.getItems = function() { return items.slice(0); }  // Defensive copy
	
	this.getElements = function(result) {
		result.add("e");
		for (var i = 0; i < items.length; i++)
			items[i].getElements(result);
	}
	
	this.countElement = function(name) {
		if (name == "e") {
			return -charge;
		} else {
			var sum = 0;
			for (var i = 0; i < items.length; i++)
				sum = checkedAdd(sum, items[i].countElement(name));
			return sum;
		}
	}
	
	this.toHtml = function() {
		var node = document.createElement("span");
		if (items.length == 0 && charge == -1) {
			node.appendChild(document.createTextNode("e"));
			var sup = document.createElement("sup");
			sup.appendChild(document.createTextNode(MINUS));
			node.appendChild(sup);
		} else {
			for (var i = 0; i < items.length; i++)
				node.appendChild(items[i].toHtml());
			if (charge != 0) {
				var sup = document.createElement("sup");
				var s;
				if (Math.abs(charge) == 1) s = "";
				else s = Math.abs(charge).toString();
				if (charge > 0) s += "+";
				else s += MINUS;
				sup.appendChild(document.createTextNode(s));
				node.appendChild(sup);
			}
		}
		return node;
	}
}


// Cân bằng có 1 hay nhiều nhóm
// Ví dụ: (OH)3
function Group(items, count)
{
	if (count < 1)
		throw _error_group_count_must_be_integer;
	items = items.slice(0);  // Xác định các biến
	
	this.getItems = function() { return items.slice(0); }  // Xác định các biến
	
	this.getCount = function() { return count; }
	
	this.getElements = function(result) {
		for (var i = 0; i < items.length; i++)
			items[i].getElements(result);
	}
	
	this.countElement = function(name) 
	{
		var sum = 0;
		for (var i = 0; i < items.length; i++)
			sum = checkedAdd(sum, checkedMultiply(items[i].countElement(name), count));
		return sum;
	}
	
	this.toHtml = function()
	{
		var node = document.createElement("span");
		node.appendChild(document.createTextNode("("));
		for (var i = 0; i < items.length; i++)
			node.appendChild(items[i].toHtml());
		node.appendChild(document.createTextNode(")"));
		if (count != 1) {
			var sub = document.createElement("sub");
			sub.appendChild(document.createTextNode(count.toString()));
			node.appendChild(sub);
		}
		return node;
	}
}


// Các nguyên tử đơn 
// Ví dụ: N2, O2, abc
function Element(name, count)
{
	if (count < 1)
		throw _error_group_count_must_be_integer;
	this.getName = function() { return name; }
	this.getCount = function() { return count; }
	this.getElements = function(result) { result.add(name); }
	this.countElement = function(n) { return n == name ? count : 0; }
	this.toHtml = function() {
		var node = document.createElement("span");
		node.appendChild(document.createTextNode(name));
		if (count != 1) {
			var sub = document.createElement("sub");
			sub.appendChild(document.createTextNode(count.toString()));
			node.appendChild(sub);
		}
		return node;
	}
}


/* các hàm để phân tích phương trình */
// Update 20/3/2012

function parseEquation(tok) {
	var lhs = [];
	var rhs = [];
	
	lhs.push(parseTerm(tok));
	while (true) {
		var next = tok.peek();
		if (next == "=")
			break;
		if (next == null)
			throw {message: _error_plus_or_equal_sign_expected, start: tok.position()};
		if (next != "+")
			throw {message: _error_plus_expected, start: tok.position()};
		tok.take();  
		lhs.push(parseTerm(tok));
	}
	
	if (tok.take() != "=")
		throw "Assertion error";
	
	rhs.push(parseTerm(tok));
	while (true) {
		var next = tok.peek();
		if (next == null)
			break;
		if (next != "+")
			throw {message: _error_plus_expected, start: tok.position()};
		tok.take();  // Consume "+"
		rhs.push(parseTerm(tok));
	}
	
	return new Equation(lhs, rhs);
}


function parseTerm(tok) 
{
	var startPosition = tok.position();
	
	// groups and elements
	var items = [];
	while (true) {
		var next = tok.peek();
		if (next == null)
			break;
		else if (next == "(")
			items.push(parseGroup(tok));
		else if (/^[A-Za-z][a-z]*$/.test(next))
			items.push(parseElement(tok));
		else
			break;
	}
	
	// optional charge
	var charge = 0;
	var next = tok.peek();
	if (next != null && next == "^") {
		tok.take();  // Consume "^"
		next = tok.peek();
		if (next == null)
			throw {message: _error_plus_expected, start: tok.position()};
		else if (/^[0-9]+$/.test(next)) {
			charge = checkedParseInt(next, 10);
			tok.take();  // The number
			next = tok.peek();
		} else
			charge = 1;
		
		if (next == null)
			throw {message: _error_sign_expected, start: tok.position()};
		else if (next == "+"); 
		else if (next == "-")
			charge = -charge;
		else
			throw {message: _error_sign_expected, start: tok.position()};
		tok.take(); 
	}
	
	// Check if term is valid
	var elems = new Set();
	for (var i = 0; i < items.length; i++)
		items[i].getElements(elems);
	elems = elems.toArray();  // Danh sách của tất cả các chất tham gia phản ứng
	if (items.length == 0) 
	{
		throw {message: _error_invalid_term, start: startPosition, end: tok.position()};
	} 
	else if (indexOf(elems, "e") != -1) 
	{  // If it's the special electron element
		if (items.length > 1 || charge != 0 && charge != -1)
			throw {message: _error_invalid_term, start: startPosition, end: tok.position()};
		items = [];
		charge = -1;
	} 
	else 
	{ 
		for (var i = 0; i < elems.length; i++) {
			if (/^[a-z]+$/.test(elems[i]))
				throw {message: _yeu_to_khong_hop_le + ' "' + elems[i] + '"', start: startPosition, end: tok.position()};
		}
	}
	
	return new Term(items, charge);
}


function parseGroup(tok) 
{
	if (tok.take() != "(")
		throw "Assertion error";
	
	var items = [];
	while (true) {
		var next = tok.peek();
		if (next == null)
			throw {message: _closing_expected, start: tok.position()};
		else if (next == "(")
			items.push(parseGroup(tok));
		else if (/^[A-Za-z][a-z]*$/.test(next))
			items.push(parseElement(tok));
		else if (next == ")")
			break;
		else
			throw {message: _closing_expected, start: tok.position()};
	}
	
	if (tok.take() != ")")
		throw "Lỗi";
	
	return new Group(items, parseCount(tok));
}


function parseElement(tok)
{
	var name = tok.take();
	if (!/^[A-Za-z][a-z]*$/.test(name))
		throw "Lỗi";
	return new Element(name, parseCount(tok));
}


// Tìm số lượng của các nguyên tử
function parseCount(tok) 
{
	var next = tok.peek();
	if (next != null && /^[0-9]+$/.test(next))
		return checkedParseInt(tok.take(), 10);
	else
		return 1;
}

// Đối tượng Class Tokenizer --> Power by .... Don't ask me why :)   
function Tokenizer( str ) 
{
	var i = 0;
	
	this.position = function() {
		return i;
	}
	
	this.peek = function() {
		if (i == str.length)
			return null;  // End of stream
		
		var match = /^([A-Za-z][a-z]*|[0-9]+| +|[+\-^=()])/.exec(str.substring(i));
		if (match == null)
			throw {message: _invalid_symbol, start: i};
		
		var token = match[0];
		if (/^ +$/.test(token)) {  // 
			i += token.length;
			token = this.peek();  // 
		}
		return token;
	}
	
	this.take = function() {
		var result = this.peek();
		i += result.length;
		return result;
	}
}


/* Ma trận object - Thank for Google */

function Matrix(rows, cols) {
	var cells = [];
	for (var i = 0; i < rows; i++) {
		var row = [];
		for (var j = 0; j < cols; j++)
			row.push(0);
		cells.push(row);
	}
	
	this.rowCount = function() { return rows; }
	this.columnCount = function() { return cols; }
	
	this.get = function(r, c) {
		if (r < 0 || r >= rows || c < 0 || c >= cols)
			throw _index_out_of_bounds;
		return cells[r][c];
	}
	
	this.set = function(r, c, val) {
		if (r < 0 || r >= rows || c < 0 || c >= cols)
			throw _index_out_of_bounds;
		cells[r][c] = val;
	}
	
	function swapRows(i, j) {
		if (i < 0 || i >= rows || j < 0 || j >= rows)
			throw _index_out_of_bounds;
		var temp = cells[i];
		cells[i] = cells[j];
		cells[j] = temp;
	}
	
	// Ví dụ, addRow([3, 1, 4], [1, 5, 6]) = [4, 6, 10].
	function addRows(x, y) {
		var z = x.slice(0);
		for (var i = 0; i < z.length; i++)
			z[i] = checkedAdd(x[i], y[i]);
		return z;
	}
	
	// Ví dụ, multiplyRow([0, 1, 3], 4) = [0, 4, 12].
	function multiplyRow(x, c) {
		var y = x.slice(0);
		for (var i = 0; i < y.length; i++)
			y[i] = checkedMultiply(x[i], c);
		return y;
	}
	
	// gcdRow([3, 6, 9, 12]) = 3.
	function gcdRow(x) {
		var result = 0;
		for (var i = 0; i < x.length; i++)
			result = gcd(x[i], result);
		return result;
	}
	
	// simplifyRow([0, -2, 2, 4]) = [0, 1, -1, -2].
	function simplifyRow(x) {
		var sign = 0;
		for (var i = 0; i < x.length; i++) {
			if (x[i] > 0) {
				sign = 1;
				break;
			} else if (x[i] < 0) {
				sign = -1;
				break;
			}
		}
		var y = x.slice(0);
		if (sign == 0)
			return y;
		var g = gcdRow(x) * sign;
		for (var i = 0; i < y.length; i++)
			y[i] /= g;
		return y;
	}
	
	this.gaussJordanEliminate = function() {
		for (var i = 0; i < rows; i++)
			cells[i] = simplifyRow(cells[i]);
		var numPivots = 0;
		for (var i = 0; i < cols; i++) {
			var pivotRow = numPivots;
			while (pivotRow < rows && cells[pivotRow][i] == 0)
				pivotRow++;
			if (pivotRow == rows)
				continue;
			var pivot = cells[pivotRow][i];
			swapRows(numPivots, pivotRow);
			numPivots++;
			
			for (var j = numPivots; j < rows; j++) {
				var g = gcd(pivot, cells[j][i]);
				cells[j] = simplifyRow(addRows(multiplyRow(cells[j], pivot / g), multiplyRow(cells[i], -cells[j][i] / g)));
			}
		}
		
		for (var i = rows - 1; i >= 0; i--)
		{
			var pivotCol = 0;
			while (pivotCol < cols && cells[i][pivotCol] == 0)
				pivotCol++;
			if (pivotCol == cols)
				continue;
			var pivot = cells[i][pivotCol];
			
			for (var j = i - 1; j >= 0; j--) {
				var g = gcd(pivot, cells[j][pivotCol]);
				cells[j] = simplifyRow(addRows(multiplyRow(cells[j], pivot / g), multiplyRow(cells[i], -cells[j][pivotCol] / g)));
			}
		}
	}
	
	this.toString = function() {
		var result = "[";
		for (var i = 0; i < rows; i++) {
			if (i != 0) result += "],\n";
			result += "[";
			for (var j = 0; j < cols; j++) {
				if (j != 0) result += ", ";
				result += cells[i][j];
			}
			result += "]";
		}
		return result + "]";
	}
}


// Thiết lập //

function Set()
{
	var items = [];
	this.add = function(obj) { if (indexOf(items, obj) == -1) items.push(obj); }
	this.contains = function(obj) { return items.indexOf(obj) != -1; }
	this.toArray = function() { return items.slice(0); }  // Defensive copy
}


var NBSP  = "\u00A0";  // Khoảng trắng
var MINUS = "\u2212";  // Dấu cộng 

var SO_LON_NHAT = 9007199254740992;  // 9007199254740992 =  2^53  --> Cái số này gọi là lớn nhất

function checkedParseInt(str) {
	var result = parseInt(str, 10);
	if (isNaN(result))
		throw _not_a_number;
	if (result <= -SO_LON_NHAT || result >= SO_LON_NHAT)
		throw _arithmetic_overflow;
	return result;
}

function checkedAdd(x, y) {
	var z = x + y;
	if (z <= -SO_LON_NHAT || z >= SO_LON_NHAT)
		throw _arithmetic_overflow;
	return z;
}

function checkedMultiply(x, y) {
	var z = x * y;
	if (z <= -SO_LON_NHAT || z >= SO_LON_NHAT)
		throw _arithmetic_overflow;
	return z;
}


function gcd(x, y) {
	if (typeof x != "number" || typeof y != "number" || isNaN(x) || isNaN(y))
		throw "Invalid argument";
	x = Math.abs(x);
	y = Math.abs(y);
	while (y != 0) {
		var z = x % y;
		x = y;
		y = z;
	}
	return x;
}

/*
		function _tooltip()
		{
			$c = document.getElementById('id');
			if( $c == '' ) return false;
			if (/^[A-Za-z][a-z]*$/.test( $c ) )
			{
				
			}
		}
*/