import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { SeleccionarAsignaturaPage } from './seleccionar-asignatura.page';

const routes: Routes = [
  {
    path: '',
    component: SeleccionarAsignaturaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class SeleccionarAsignaturaPageRoutingModule {}
