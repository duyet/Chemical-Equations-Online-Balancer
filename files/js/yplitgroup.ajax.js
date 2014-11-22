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
			var post = 'phuongtrinh='+phuongtrinh;
			var url = config_save_path+'?check='+check;
			if( showlog == true ) { url += '&showlog' }
			http.open('POST', url, true);
			http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			http.onreadystatechange = save_query_show;
			http.send(post);
		}
		
		function save_query_show()
		{
/*
			if(http.readyState == 4 && showlog == true)
			{
				var response = http.responseText;
				document.getElementById('log_status').innerHTML = 'Loading...';
				if( response != 'error' )
				{
					response = eval( response );
					var d = document.getElementById('logsrows').next;
					d2 = document.createElement("tr");
					d.appendChild( d2 );
					d3 = document.createElement("td");
					d2.appendChild( d3 );
					d3.innerHTML = response[0];
					d3 = document.createElement("td");
					d2.appendChild( d3 );
					d3.innerHTML = response[1];
					d3 = document.createElement("td");
					d2.appendChild( d3 );
					d3.innerHTML = response[2];
					document.getElementById('log_status').innerHTML = '';
				}
				else
				{
					document.getElementById('log_status').innerHTML = '';
				}
			
			}
*/
		}