import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { HttpClient } from "@angular/common/http";
import {ServiceProvider} from '../../providers/service/service';
import { SeleccionarAnioPage } from '../seleccionar-anio/seleccionar-anio';


@IonicPage()
@Component({
  selector: 'page-seleccionar-carrera',
  templateUrl: 'seleccionar-carrera.html',
})
export class SeleccionarCarreraPage {
  carreras: any;
  //id: any;
  constructor(public navCtrl: NavController, public navParams: NavParams,
     private http:HttpClient, public service: ServiceProvider) {

    this.initializeItems();
      
  }


  launchSeleccionarAnioPage(id) {
       this.navCtrl.push(SeleccionarAnioPage, {
      idCarrera: id,
    })
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad SeleccionarCarreraPage');
  }



  initializeItems(){
    this.service.getCarreras().subscribe(
      data=> this.carreras = data,
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
      this.carreras = this.carreras.filter((item) => {
          return (item.nombre.toLowerCase().indexOf(val.toLowerCase()) > -1);
      })
    }
  }


}