import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { SeleccionarProgramaPage } from '../seleccionar-programa/seleccionar-programa';

@IonicPage()
@Component({
  selector: 'page-seleccionar-anio',
  templateUrl: 'seleccionar-anio.html',
})
export class SeleccionarAnioPage {
  public idCarrera;
  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.initializeItems();
    this.idCarrera = navParams.get("idCarrera");
    console.log("ID:"+this.idCarrera);
  }

   launchSeleccionarProgramaPage() {
    this.navCtrl.push(SeleccionarProgramaPage, {
      idCarrera: this.idCarrera,
    })
  }

  searchQuery: string = '';
  items: string[];

  getItems(ev: any) {
    // Restablece todos los items de nuevo
    this.initializeItems();

    // Setea 'val' segun el valor de la search bar
    const val = ev.target.value;

    // Si el valor es una cadena vacia, no filtra los items
    if (val && val.trim() != '') {
      this.items = this.items.filter((item) => {
        return (item.toLowerCase().indexOf(val.toLowerCase()) > -1);
      })
     
    }
  }

  initializeItems() {
    this.items = [
      '2018',
      '2017',
      '2016',
      '2015',
      '2014',
      '2013',
      '2012',
      '2011'
    ];
  }


  ionViewDidLoad() {
    console.log('ionViewDidLoad SeleccionarAnioPage');
  }




}
