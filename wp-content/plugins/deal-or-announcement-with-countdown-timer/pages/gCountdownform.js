/**
 *     deal or announcement with countdown timer
 *     Copyright (C) 2011 - 2015 www.gopiplus.com
 *     http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
function gCountdownform()
{
	if(document.gCountform.gCount.value=="")
	{
		alert("Please enter the announcement text.")
		document.gCountform.gCount.focus();
		return false;
	}
	else if(document.gCountform.gCountdisplay.value=="")
	{
		alert("Please select the display status.")
		document.gCountform.gCountdisplay.focus();
		return false;
	}
	else if(document.gCountform.gCountmonth.value=="")
	{
		alert("Please select the expiration month.")
		document.gCountform.gCountmonth.focus();
		return false;
	}
	else if(document.gCountform.gCountdate.value=="")
	{
		alert("Please select the expiration date.")
		document.gCountform.gCountdate.focus();
		return false;
	}
	else if(document.gCountform.gCountyear.value=="")
	{
		alert("Please select the expiration year.")
		document.gCountform.gCountyear.focus();
		return false;
	}
	else if(document.gCountform.gCounthour.value=="")
	{
		alert("Please select the expiration time.")
		document.gCountform.gCounthour.focus();
		return false;
	}
	else if(document.gCountform.gCountzoon.value=="")
	{
		alert("Please select the expiration time zoon AM/PM.")
		document.gCountform.gCountzoon.focus();
		return false;
	}
}

function gCountdelete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm_gCountdisplay.action="options-general.php?page=deal-with-countdown&ac=del&did="+id;
		document.frm_gCountdisplay.submit();
	}
}	

function gCountredirect()
{
	window.location = "options-general.php?page=deal-with-countdown";
}

function gCounthelp()
{
	window.open("http://www.gopiplus.com/work/2010/07/18/deal-or-announcement-with-countdown-timer/");
}