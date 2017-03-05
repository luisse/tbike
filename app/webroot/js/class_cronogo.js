/*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU General Public License as published by
*    the Free Software Foundation, either version 3 of the License, or
*    (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU General Public License for more details.
*
*    You should have received a copy of the GNU General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>
*    @author Luis Sebastian oppe-oppeluis@gmail.com
*    @Fecha 10/10/2013
*    @use Biblioteca para visualizar funcionalidad de cronometro
*/

function Cronogo(){
	this.InicTime=0;
	this.ActualTime=0;
	this.AuxTime=new Date();
	this.Old=new Date();
	this.run=false;
	this.call_id = 0;
	this.Hours=0;
	this.Minutes=0;
	this.Seconds=0;
	this.Milliseconds=0;
	this.ViewCronogo='';
	this.ObjectButtonStop='';
	this.timerunning='';
};

	/*
	* Entry java a JSON VAR WITH PARM
	* ViewCronogo: 'objectId'
	* ObjectButtonStop: 'objectid'
	*/
	Cronogo.prototype.initclock = function(entry){
		this.Old.setTime(0);
		this.Old.setHours(0,0,0,0);


		this.InicTime = entry.hour_init != undefined ? entry.hour_init : new Date();
		this.ViewCronogo = entry.ViewCronogo;
		//if(entry.hour_init != undefined){
			//this.Old = entry.hour_init;
		//}

		this.ObjectButtonStop = entry.ObjectButtonStop;
		$(entry.ViewCronogo).val('00:00:00');
	}

	Cronogo.prototype.saveOld = function(){
		this.Old.setTime(this.ActualTime.getTime() - this.InicTime.getTime() + this.Old.getTime());
		this.Hours=0;
		this.Minutes=0;
		this.Seconds=0;
	}

	Cronogo.prototype.resetClock = function(){
		if(this.run){
			this.run = false;
		}

		this.Hours = 0;
		this.Minutes = 0;
		this.Seconds = 0;
		this.Old.setTime(0);
		this.Old.setHours(0,0,0,0);
	}

	Cronogo.prototype.getstatus = function(){
		return this.run;
	}

	Cronogo.prototype.pauseClock = function(){
		self = this;
		if(!this.run)
		{
			this.run = true;
			$(this.ObjectButtonStop).removeClass('media-icon media-play').addClass('media-icon media-stop');
			this.InicTime = this.InicTime != undefined ? this.InicTime : new Date();
			this.ActualTime = this.InicTime;
			self.showClock();
		}
		else
		{
			this.run = false;
			$(this.ObjectButtonStop).removeClass('media-icon media-stop').addClass('media-icon media-play');
			self.saveOld();
		}
	}

 Cronogo.prototype.showClock = function(){
	  self = this;
		var ls_hours = ''
		var ls_minutes = ''
		var ls_seconds = ''
		if(this.run)
		{
			this.ActualTime = new Date();
			this.AuxTime.setHours(0,0,0);
			this.AuxTime.setTime(this.ActualTime.getTime() - this.InicTime.getTime() + this.Old.getTime());
			this.Seconds = (this.AuxTime.getSeconds());
			this.Minutes = (this.AuxTime.getMinutes());
			this.Hours = (this.AuxTime.getHours());
			ls_hours =this.Hours.toString();
			ls_minutes = this.Minutes.toString();
			ls_seconds = this.Seconds.toString();
			if(ls_hours.length <= 1) ls_hours = '0'+ls_hours;
			if(ls_minutes.length <= 1) ls_minutes = '0'+ls_minutes;
			if(ls_seconds.length <= 1) ls_seconds = '0'+ls_seconds;
			this.timerunning = ls_hours+':'+ls_minutes+':'+ls_seconds;
			$(this.ViewCronogo).text(ls_hours+':'+ls_minutes+':'+ls_seconds)
			 this.call_id = setInterval(function(){self.showClock()}, 500);
		}
}

exports = Cronogo;
