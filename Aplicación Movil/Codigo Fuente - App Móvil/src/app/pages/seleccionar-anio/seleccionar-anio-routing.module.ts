import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SeleccionarAnioPage } from './seleccionar-anio.page';

const routes: Routes = [
  {
    path: '',
    component: SeleccionarAnioPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SeleccionarAnioPageRoutingModule {}
