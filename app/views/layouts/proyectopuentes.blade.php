<li id="proyectoactive" >
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-desktop"></i>
							<span class="menu-text"> Proyecto {{ isset(Session::get('proyecto')->nombre) ? Session::get('proyecto')->nombre : ""}} </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<!--
							<li>
								<a href={{ URL::to('proyectos/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('proyectos') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>
							-->

							<li id='obraactive'>
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-legal"></i>
							<span class="menu-text"> Obras </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('obras/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('obras') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>




					<li id="partidasactive"> 
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-list"></i>
							<span class="menu-text"> Partidas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('partidas/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('partidas') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>





					<li id="apuactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-adn"></i>
							<span class="menu-text"> APU </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('apu/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('apu') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>



<li id="gastogeneralactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
							<span class="menu-text"> Gastos Generales </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('gastogeneral/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('gastogeneral') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>


							
						</ul>
					</li>

				
					



					

<li id="controlcostoactive">
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-adn"></i>

									Control de costos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<ul class="submenu">
									

									<li id="controlgastoactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
					<span class="menu-text"> Control de gastos </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('controlgasto/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('controlgasto') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>



									<li id="controlingresoactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-usd"></i>
					<span class="menu-text">Ingresos </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('controlingreso/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('controlingreso') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>





				</ul><!--/.nav-list-->
			</li>







					<li id="chequeactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-list-alt"></i>
					<span class="menu-text"> Cheques </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<!--
							<li>
								<a href={{ URL::to('cheques/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>
-->
							<li>
								<a href={{ URL::to('cheques') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							
						</ul>
					</li>


					<li>
								<a href={{ URL::to('controlgasto/informecontabilidad') }}>
									<i class="fa fa-angle-double-right"></i>
									Informe de Contabilidad
								</a>
							</li>


					<li id="presupuestoactive">
						<a href={{ URL::to('presupuesto/nuevo') }} class="dropdown-toggle">
							<i class="fa fa-list-alt"></i>
					<span class="menu-text"> Presupuesto </span>

						</a>

					
					</li>


					<li id="ordencompraactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-book"></i>
					<span class="menu-text"> Orden de compra </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('ordencompra/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('ordencompra') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

						

							<li id="proveedoractive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-user"></i>
					<span class="menu-text"> Proveedor </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('proveedor/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('proveedor') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							

							
						</ul>
					</li>


					

							
						</ul>
					</li>


					<li id="informeactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-line-chart"></i>
					<span class="menu-text"> Informes </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('informes/analisiscosto') }}>
									<i class="fa fa-angle-double-right"></i>
									Analisis de costos 
								</a>
							</li>

						

							
						</ul>
					</li>



					<li id="bodegaactive">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-suitcase"></i>
					<span class="menu-text"> Bodega </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<ul class="submenu">
							<li>
								<a href={{ URL::to('bodega/nuevo') }}>
									<i class="fa fa-angle-double-right"></i>
									Ingresar
								</a>
							</li>

							<li>
								<a href={{ URL::to('bodega') }}>
									<i class="fa fa-angle-double-right"></i>
									Ver/Editar
								</a>
							</li>

							

							
						</ul>
					</li>


					


				</ul><!--/.nav-list-->