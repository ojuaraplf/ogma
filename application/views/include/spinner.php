<style type="text/css">

.stop-scrolling {
  height: 100%;
  overflow: hidden;
}

#divSpinner {
	display: block;
  position: fixed; /* Stay in place */
   z-index: 99;/* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  /*background-color: rgba(255,255,255,0.9);*/
  /*background-color: rgb(0,0,0); /* Fallback color */*/
  /*background-color: rgba(0,0,0,0.4); /* Black w/ opacity */*/

}
#spinner {
	width: 100px;
	height: 100px;
	 top:50%;
    left:50%;
    position:absolute;
    margin-left: -50px;/* half width*/
    margin-top: -50px;/* half height*/
}

</style>


<div id="divSpinner">
	<div class="spinner-grow" id="spinner" role="status">
  	<span class="sr-only">Loading...</span>
	</div>
</div>
