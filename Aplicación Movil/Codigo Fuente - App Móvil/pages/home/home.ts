import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { SeleccionarCarreraPage } from '../seleccionar-carrera/seleccionar-carrera';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  constructor(public navCtrl: NavController) {

  }
  launchSeleccionarCarreraPage(){
    this.navCtrl.push(SeleccionarCarreraPage);
   }
}
