import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

import { File } from '@ionic-native/file';
import { DocumentViewer, DocumentViewerOptions } from '@ionic-native/document-viewer';
import { FileTransfer } from '@ionic-native/file-transfer';
import { Platform } from 'ionic-angular';

import { HttpClient } from "@angular/common/http";
import {ServiceProvider} from '../../providers/service/service';
import { Identifiers } from '@angular/compiler';

@IonicPage()
@Component({
  selector: 'page-seleccionar-programa',
  templateUrl: 'seleccionar-programa.html',
})
export class SeleccionarProgramaPage {

  asignaturas: any;
  public idCarrera;
 
  constructor(public navCtrl: NavController, private document: DocumentViewer, 
    private file: File, private transfer: FileTransfer, 
    public platform: Platform, private http:HttpClient, public service: ServiceProvider, 
    public navParams: NavParams) { 
      this.initializeItems();
      this.idCarrera = navParams.get("idCarrera");
      console.log("ID:"+this.idCarrera);
  }
  

  openLocalPdf() {
    const options: DocumentViewerOptions = {
      title: 'My PDF'
    }
    this.document.viewDocument('../assets/prueba.pdf', 'application/pdf', options);
  }
  ionViewDidLoad() {
    console.log('ionViewDidLoad SeleccionarProgramaPage');
  }

  downloadAndOpenPdf(id) {
    let path = null;
    if (this.platform.is('ios')) {
      path = this.file.documentsDirectory;
    } else if (this.platform.is('android')) {
      path = this.file.dataDirectory;
    }
    const transfer = this.transfer.create();
    transfer.download('https://unpabimodal.unpa.edu.ar/programas/actual/prg_'
    +id+'_'+this.idCarrera+'_uarg_pact.pdf', path + 'Programa.pdf').then(entry => {
      let url = entry.toURL();
      this.document.viewDocument(url, 'application/pdf', {});
    });
  }



  initializeItems(){
    this.service.getData().subscribe(
      data=> this.asignaturas = data,
      err=>console.log(err)
    );
  }



  getItems(ev: any) {
     // Setea 'val' segun el valor de la search bar
    const val = ev.target.value;
    if(val == ''){
      this.initializeItems();
    }

    // Si el valor es una cadena vacia, no filtra los items
    if (val && val.trim() != '') {
      this.asignaturas = this.asignaturas.filter((item) => {
          return (item.nombre.toLowerCase().indexOf(val.toLowerCase()) > -1);
      })
    }
  }







}



