import { Component, OnInit } from '@angular/core';
import { ApiserviceService } from '../../servicios/apiservice.service';
import { Router, ActivatedRoute } from '@angular/router';
import { Platform } from '@ionic/angular';
import { FileOpener } from '@ionic-native/file-opener/ngx';
import { File } from '@ionic-native/file/ngx';
import { DocumentViewer, DocumentViewerOptions } from '@ionic-native/document-viewer/ngx';
import { FileTransfer } from '@ionic-native/file-transfer/ngx';

@Component({
  selector: 'app-seleccionar-anio',
  templateUrl: './seleccionar-anio.page.html',
  styleUrls: ['./seleccionar-anio.page.scss'],
})
export class SeleccionarAnioPage implements OnInit {
  anios: any;
  idAsignatura: any;
  idPlan: any;
  mensaje: String;
  constructor(public servicio: ApiserviceService, private router: Router,
    private route: ActivatedRoute, 
    private platform: Platform, private file: File,
    private ft: FileTransfer, private fileOpener: FileOpener, 
    private document: DocumentViewer) {
      this.initializeItems(servicio);
  }

  
  initializeItems(servicio: ApiserviceService){
    this.route.queryParams.subscribe((params) => {
      this.idAsignatura = params['idAsignatura'];
      this.idPlan = params['idPlan'];
      console.log("La asignatura que llegó: "+this.idAsignatura)
      console.log("El plan que llegó: "+this.idPlan)
      servicio.getProgramasDisponibles(this.idAsignatura).subscribe(
        data=> this.anios = data,
        err=>console.log(err)
      );
    });
  }


  ngOnInit() {
  }

  
  getItems(ev: any) {
    let valor: any;
     // Setea 'val' segun el valor de la search bar
     valor = ev.target.value;
    if(valor == ''){
      this.initializeItems(this.servicio);
    }
   //falta arreglar el caso del borrado de caracteres ev.detail.data === null ocurre cuando se borra
    if(ev.detail.data === null){
     console.log(ev.target.value)
     valor = ev.target.value
    }
    // Si el valor es una cadena vacia, no filtra los items
    if (valor && valor.trim() != '') {
     console.log("valor de busqueda"+valor);
     this.anios = this.anios.filter((item) => {
       return (item.nombre.toLowerCase().includes(valor.toLowerCase()));
       })
     }
   }

  /*
  //Este metodo serviria para buscar PDFs de forma local
  openLocalPdf(){
    let filePath = this.file.applicationDirectory + 'www/assets';
    if(this.platform.is('android')){
      let fakeName = Date.now();
      this.file.copyFile(filePath, 'prueba.pdf', this.file.dataDirectory , `${fakeName}.pdf`).then(result => {
        this.fileOpener.open(result.nativeURL, 'application/pdf');
      });
    } 
    else{
      const options: DocumentViewerOptions = {
        title: 'My PDF'
      }
      this.document.viewDocument(`${filePath}/prueba.pdf`, 'application/pdf', options);
    }
  }
*/
  /*
  // Este método funciona pero sacando un PDF de ejemplo internet. La idea es usar el otro metodo que busca en VASPA los PDF
  downloadAndOpenPdf(){
    let downloadUrl = 'http://gis.trrsugar.com/5-simple-hacks-LBT.pdf';
    let path = this.file.dataDirectory;
    const transfer = this.ft.create();

    transfer.download(downloadUrl, `${path}myfile.pdf`).then(entry => {
      let url = entry.toURL();
      if (this.platform.is('ios')){
        this.document.viewDocument(url,'application/pdf', {});
      }
      else{
        this.fileOpener.open(url, 'application/pdf');
      }
    })
    */

   downloadAndOpenPdf(anio){
    let path = this.file.dataDirectory;
    const transfer = this.ft.create();
    
    //recuperamos el id de carrera como substring del IDPlan
    let idCarrera = this.idPlan.substring(0,3);
    //armamos la raíz de la URL de descarga
    let url = 'http://192.168.0.107/vaspa/CodigoFuente/programas/'+anio+'/';

    //console.log("donwload url"+downloadUrl);
    //Armamos nombre del archivo
    let fileName = 'prg_'+this.idAsignatura+'_'+idCarrera+'_uarg_pact.pdf';  //prg_1659_016_uarg_pact.pdf

    let downloadUrl = url+fileName;
    console.log(downloadUrl);
    transfer.download(downloadUrl, `${path}Programa.pdf`).then(entry => {
      let url = entry.toURL();
      if (this.platform.is('ios')){
        this.document.viewDocument(url,'application/pdf', {});
      }
      else{
        this.fileOpener.open(url, 'application/pdf');
      }
    })


  }

}
