<?php 
	$zip_file = "all-image.zip";
	touch($zip_file);
	// end
	

	// open zip file
	$zip = new ZipArchive;
	$this_zip = $zip->open($zip_file);

if($this_zip){

		$folder = opendir('idcards/');
    //echo "<a href='idcards/'>View</a>";

		if($folder){
			while( false !== ($image = readdir($folder))){
				if($image !== "." && $image !== ".."){
					
					$file_with_path = "idcards/".$image;

					$zip->addFile($file_with_path,$image);
				}
			}
			closedir($folder);
		}
    
// download this created zip file
    
		if(file_exists($zip_file))  
		{  
			//name when download
			 $demo_name = "your-all-images.zip";

		     header('Content-type: application/zip');  
		     header('Content-Disposition: attachment; filename="'.$demo_name.'"');  
		     readfile($zip_file); // auto download

		     //delete this zip file after download
		     unlink($zip_file);  
		} 
  }

?>