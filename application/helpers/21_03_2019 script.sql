/*ALTER TABLE "MDB_GRAL"."GRAL_PARAMETROS"
ADD COLUMN "FLGACTI" character(1) DEFAULT 1;

CREATE OR REPLACE FUNCTION "MDB_GRAL"."GRAL_COMBOPARAMETROS"(flgcategoria character varying)
    RETURNS SETOF "MDB_GRAL"."PARAMETROS_RESULT"
    LANGUAGE 'plpgsql'
    VOLATILE
    PARALLEL UNSAFE
    COST 100    ROWS 1000
AS $BODY$BEGIN
 RETURN QUERY
 SELECT "TXTPARAMETRO",
     "TXTVALOR"
   FROM "MDB_GRAL"."GRAL_PARAMETROS"
  WHERE "FLGCATEGORIA" = FLGCATEGORIA
    AND "FLGACTI" = '1';
END;
$BODY$;

DROP FUNCTION  "MDB_GRAL"."GRAL_INTRALOGIN";

DROP TYPE "MDB_GRAL"."INTRANET_RESULT";

CREATE SEQUENCE "MDB_SEG"."SEG_USUARIO_MDB_IDUSUARIO_seq";
ALTER SEQUENCE "MDB_SEG"."SEG_USUARIO_MDB_IDUSUARIO_seq"
    OWNER TO postgres;

CREATE TABLE "MDB_SEG"."SEG_USUARIO_MDB"
(
    "IDUSUARIO" integer NOT NULL DEFAULT nextval('"MDB_SEG"."SEG_USUARIO_MDB_IDUSUARIO_seq"'::regclass),
    "TXTUSERNAME" text COLLATE pg_catalog."default",
    "TXTPASSWORD" character varying(60) COLLATE pg_catalog."default",
    "TXTCORREO" character varying(50) COLLATE pg_catalog."default",
    "DAREGISTRO" timestamp without time zone DEFAULT now(),
    "FLGACTI" character varying(1) COLLATE pg_catalog."default" DEFAULT 1,
    "TXTNOMBRES" character varying(100) COLLATE pg_catalog."default",
    "TXTAPELLIDOS" character varying(100) COLLATE pg_catalog."default",
    "IDAREAACTUAL" integer,
    "TXTTELEFONO" character varying(50) COLLATE pg_catalog."default",
    "DANACIMIENTO" date,
 "AUDITORIA" character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT "SEG_USUARIO_MDB_pkey" PRIMARY KEY ("IDUSUARIO")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;
ALTER TABLE "MDB_SEG"."SEG_USUARIO_MDB"
    OWNER to postgres;

CREATE TYPE "MDB_SEG"."SEG_MODULOSLOGIN_INTRANET" AS
(
	"IDUSUARIO" integer,
	"TXTUSERNAME" text,
	"TXTNOMPERSONA" text,
	"TXTAPEPATERNO" character varying(100)
);

ALTER TYPE "MDB_SEG"."SEG_MODULOSLOGIN_INTRANET"
    OWNER TO postgres;
	
CREATE OR REPLACE FUNCTION "MDB_SEG"."SEG_LOGIN_INTRANET"(
	usuario text,
	contra text)
    RETURNS SETOF "MDB_SEG"."SEG_MODULOSLOGIN_INTRANET" 
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
    ROWS 1000
AS $BODY$BEGIN
	RETURN QUERY
	SELECT u."IDUSUARIO",u."TXTUSERNAME", 
	INITCAP(substring(trim(u."TXTNOMBRES") FROM '^([^ ]+)'))
					  ,u."TXTAPELLIDOS"
		FROM "MDB_SEG"."SEG_USUARIO_MDB" u
		WHERE LOWER(u."TXTUSERNAME") = LOWER(USUARIO) 
	      AND u."TXTPASSWORD" = CONTRA 
		  AND u."FLGACTI" = '1';
END;
$BODY$;

ALTER FUNCTION "MDB_SEG"."SEG_LOGIN_INTRANET"(text, text)
    OWNER TO postgres;

ALTER TABLE "MDB_SEG"."SEG_USUARIO_MDB"
    ADD COLUMN "TXTURLIMAGEN" character varying(20);

CREATE OR REPLACE FUNCTION "MDB_SEG"."SEG_REGISTRARUSUARIO"(
	TXTUSERNAME text,
	TXTCORREO character varying,
	TXTNOMBRES character varying,
	TXTAPELLIDOS character varying,
	IDAREAACTUAL integer,
	TXTTELEFONO character varying,
	DANACIMIENTO date,
	IDROL integer)
    RETURNS character varying
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
AS $BODY$
DECLARE
    _msj             CHARACTER VARYING;
    _idusuario        CHARACTER VARYING;
BEGIN
    _msj := 'OK';
	INSERT INTO "MDB_SEG"."SEG_USUARIO"(
	"TXTUSERNAME", "TXTPASSWORD", "TXTCORREO",  "TXTNOMBRES", 
	"TXTAPELLIDOS", "IDAREAACTUAL", "TXTTELEFONO", "DANACIMIENTO")
	VALUES (TXTUSERNAME, '123', TXTCORREO,  TXTNOMBRES, TXTAPELLIDOS, IDAREAACTUAL, TXTTELEFONO, DANACIMIENTO)
	RETURNING "IDUSUARIO" INTO _idusuario;
	
	INSERT INTO "MDB_SEG"."SEG_ROLUSUARIO"("IDROL", "IDUSUARIO") VALUES (IDROL, _idusuario::integer);
	
    RETURN _idusuario;
EXCEPTION
    WHEN OTHERS THEN
        GET STACKED DIAGNOSTICS _msj = PG_EXCEPTION_CONTEXT;
        SELECT CONCAT('Hubo un error : ', SQLERRM,' - ',SQLSTATE,' Stack: ',_msj) INTO _msj;
        RETURN _msj;
END
$BODY$;

CREATE TABLE "MDB_REC"."REC_CASO"
(
    "IDCASO" integer NOT NULL DEFAULT nextval('"MDB_REC"."REC_CASO_IDCASO_seq"'::regclass),
    "TXTDESCRIPCION" text COLLATE pg_catalog."default",
    "TXTCODIGO" character varying(10) COLLATE pg_catalog."default",
    "IDSEDE" integer,
    "IDPERSONA" integer,
    CONSTRAINT "REC_CASO_pkey" PRIMARY KEY ("IDCASO")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "MDB_REC"."REC_CASO"
    OWNER to postgres;

ALTER TABLE "MDB_REC"."REC_CASO"
    ADD CONSTRAINT "FK_GRAL_SEDE_IDSEDE_02" FOREIGN KEY ("IDSEDE")
    REFERENCES "MDB_GRAL"."GRAL_SEDE" ("IDSEDE") MATCH SIMPLE
    ON UPDATE CASCADE
    ON DELETE NO ACTION;

ALTER TABLE "MDB_REC"."REC_CASO"
    ADD CONSTRAINT "FK_GRAL_PERSONA_IDPERSONA_05" FOREIGN KEY ("IDPERSONA")
    REFERENCES "MDB_GRAL"."GRAL_PERSONA" ("IDPERSONA") MATCH SIMPLE
    ON UPDATE CASCADE
    ON DELETE NO ACTION;
	
CREATE OR REPLACE FUNCTION "MDB_GRAL"."GRAL_BUSCARNORMA"(
	txttipo character varying,
	numanio integer,
	nombre character varying,
	descripcion character varying)
    RETURNS SETOF "MDB_GRAL"."NORMAS_RESULT" 
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
    ROWS 1000
AS $BODY$BEGIN
	RETURN QUERY
	   
	SELECT "TXTNORMA",
		   "TXTDESCNORMA",
		   to_char("DAREGISTRO",'DD/MM/YYYY') "DAREGISTRO",
		   to_char("DANORMA",'DD/MM/YYYY') "DANORMA",
		   "NUMANIO",
		   "NUMHITS",
		   "TXTARCHIVOURL",
		   "IDNORMA"
	  FROM "MDB_GRAL"."GRAL_NORMAS"
	 WHERE "TXTTIPO" = COALESCE(TXTTIPO,"TXTTIPO")
	   AND "NUMANIO" = COALESCE(NUMANIO,"NUMANIO")
	   AND LOWER("TXTNORMA") LIKE LOWER(COALESCE('%'||nombre||'%', "TXTNORMA"))
	   AND LOWER("TXTDESCNORMA") LIKE LOWER(COALESCE('%'||descripcion||'%', "TXTDESCNORMA")) 
  ORDER BY "DANORMA" desc;
END;
$BODY$;

CREATE SEQUENCE "MDB_REC"."REC_CASO_IDCASO_seq";

ALTER SEQUENCE "MDB_REC"."REC_CASO_IDCASO_seq"
    OWNER TO postgres;

CREATE OR REPLACE FUNCTION "MDB_SAV"."SAV_INSERTARSERVICIO"(
	txttema character varying,
	txtdescripcion text,
	idmedio integer,
	idcategoria integer,
	idsubcategoria integer,
	idpersona integer)
    RETURNS character varying
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
AS $BODY$

DECLARE
    _msj             CHARACTER VARYING;
BEGIN
    _msj := 'OK';
	INSERT INTO "MDB_SAV"."SAV_CASO"(
	"TXTTEMA", "TXTDESCRIPCION", "IDMEDIO", "IDCATEGORIA", "IDSUBCATEGORIA", "IDPERSONA")
	VALUES (TXTTEMA, TXTDESCRIPCION, IDMEDIO, IDCATEGORIA, IDSUBCATEGORIA, IDPERSONA);
    RETURN _msj;
EXCEPTION
    WHEN OTHERS THEN
        GET STACKED DIAGNOSTICS _msj = PG_EXCEPTION_CONTEXT;
        SELECT CONCAT('Hubo un error: ', SQLERRM,' - ',SQLSTATE,' Stack: ',_msj) INTO _msj;
        RETURN _msj;
END

$BODY$;



CREATE SCHEMA "MDB_CON" AUTHORIZATION postgres;

CREATE SEQUENCE "MDB_CON"."CON_CONTACTO_IDCONTACTO_seq";

ALTER SEQUENCE "MDB_CON"."CON_CONTACTO_IDCONTACTO_seq"
    OWNER TO postgres;
	
-- Table: "MDB_CON"."CON_CONTACTO"

-- DROP TABLE "MDB_CON"."CON_CONTACTO";

CREATE TABLE "MDB_CON"."CON_CONTACTO"
(
    "IDCONTACTO" integer NOT NULL DEFAULT nextval('"MDB_CON"."CON_CONTACTO_IDCONTACTO_seq"'::regclass),
    "TXTMENSAJE" text COLLATE pg_catalog."default",
    "TXTASUNTO" character varying(20) COLLATE pg_catalog."default",
    "TXTCODIGO" character varying(10) COLLATE pg_catalog."default",
    "DAREGISTRO" timestamp without time zone DEFAULT now(),
    "TXTIPREGISTRO" character varying(30) COLLATE pg_catalog."default",
    "IDESTADO" integer,
    "IDTIPO" integer,
    "TXTNOMPERSONA" character varying(30) COLLATE pg_catalog."default",
    "TXTAPEPATERNO" character varying(20) COLLATE pg_catalog."default",
    "TXTAPEMATERNO" character varying(20) COLLATE pg_catalog."default",
    "TXTTELEFONO" character varying(30) COLLATE pg_catalog."default",
    "TXTCORREO" character varying(100) COLLATE pg_catalog."default",
    "TIPODOCUMENTO" integer,
    "TXTDOCUMENTO" character varying(20) COLLATE pg_catalog."default",
    CONSTRAINT "CON_CONTACTO_pkey" PRIMARY KEY ("IDCONTACTO")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "MDB_CON"."CON_CONTACTO"
    OWNER to postgres;

	
	
-- SEQUENCE: "MDB_GRAL"."GRAL_CORREOS_IDCORREO_seq"

-- DROP SEQUENCE "MDB_GRAL"."GRAL_CORREOS_IDCORREO_seq";

CREATE SEQUENCE "MDB_GRAL"."GRAL_CORREOS_IDCORREO_seq";

ALTER SEQUENCE "MDB_GRAL"."GRAL_CORREOS_IDCORREO_seq"
    OWNER TO postgres;
	
-- Table: "MDB_GRAL"."GRAL_CORREOS"

-- DROP TABLE "MDB_GRAL"."GRAL_CORREOS";

CREATE TABLE "MDB_GRAL"."GRAL_CORREOS"
(
    "IDCORREO" integer NOT NULL DEFAULT nextval('"MDB_GRAL"."GRAL_CORREOS_IDCORREO_seq"'::regclass),
    "IDAREA" integer,
    "TXTCORREO" text COLLATE pg_catalog."default",
    "IDTIPO" integer,
    "FLGACTI" character(1) COLLATE pg_catalog."default",
    CONSTRAINT "GRAL_CORREOS_pkey" PRIMARY KEY ("IDCORREO")
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "MDB_GRAL"."GRAL_CORREOS"
    OWNER to postgres;
	

-- SEQUENCE: "MDB_CON"."CON_CONTACTOMOVIMIENTO_IDMOVIMIENTO_seq"

-- DROP SEQUENCE "MDB_CON"."CON_CONTACTOMOVIMIENTO_IDMOVIMIENTO_seq";

CREATE SEQUENCE "MDB_CON"."CON_CONTACTOMOVIMIENTO_IDMOVIMIENTO_seq";

ALTER SEQUENCE "MDB_CON"."CON_CONTACTOMOVIMIENTO_IDMOVIMIENTO_seq"
    OWNER TO postgres;
	
-- Table: "MDB_CON"."CON_CONTACTOMOVIMIENTO"

-- DROP TABLE "MDB_CON"."CON_CONTACTOMOVIMIENTO";

CREATE TABLE "MDB_CON"."CON_CONTACTOMOVIMIENTO"
(
    "IDMOVIMIENTO" integer NOT NULL DEFAULT nextval('"MDB_CON"."CON_CONTACTOMOVIMIENTO_IDMOVIMIENTO_seq"'::regclass),
    "IDAREAINICIAL" integer,
    "IDAREADERIVADA" integer,
    "IDCONTACTO" integer,
    "TXTMENSAJE" text COLLATE pg_catalog."default",
    CONSTRAINT "CON_CONTACTOMOVIMIENTO_pkey" PRIMARY KEY ("IDMOVIMIENTO"),
    CONSTRAINT "FK_CON_CONTACTO_IDCONTACTO_01" FOREIGN KEY ("IDCONTACTO")
        REFERENCES "MDB_CON"."CON_CONTACTO" ("IDCONTACTO") MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    CONSTRAINT "FK_GRAL_AREA_IDAREA_03" FOREIGN KEY ("IDAREAINICIAL")
        REFERENCES "MDB_GRAL"."GRAL_AREA" ("IDAREA") MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    CONSTRAINT "FK_GRAL_AREA_IDAREA_04" FOREIGN KEY ("IDAREADERIVADA")
        REFERENCES "MDB_GRAL"."GRAL_AREA" ("IDAREA") MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE "MDB_CON"."CON_CONTACTOMOVIMIENTO"
    OWNER to postgres;

INSERT INTO "MDB_GRAL"."GRAL_PARAMETROS"(
	 "TXTPARAMETRO", "TXTVALOR", "FLGCATEGORIA")
	VALUES 
	( 'CONTACTO', 'CONTACTO', 'MODULOS'), 
	( 'RECLAMOS', 'RECLAMOS', 'MODULOS'),
	( 'ACCESO', 'ACCESO', 'MODULOS'),
	( 'TUPA', 'TUPA', 'MODULOS'),
	( 'INTRANET', 'INTRANET', 'MODULOS'),
	( 'NORMAS', 'NORMAS', 'MODULOS'),
	( 'AUDIENCIA', 'AUDIENCIA', 'MODULOS');

ALTER TABLE "MDB_GRAL"."GRAL_CORREOS"
    ADD CONSTRAINT "FK_GRAL_AREA_IDAREA_05" FOREIGN KEY ("IDAREA")
    REFERENCES "MDB_GRAL"."GRAL_AREA" ("IDAREA") MATCH SIMPLE
    ON UPDATE CASCADE
    ON DELETE NO ACTION;

-- MODIFICAR FUNCION COMBOS PARAMETROS Y TYPE
ALTER TYPE "MDB_GRAL"."PARAMETROS_RESULT"
    DROP ATTRIBUTE "TXTVALOR";
ALTER TYPE "MDB_GRAL"."PARAMETROS_RESULT"
    ADD ATTRIBUTE "IDPARAMETRO" integer;

-- MODIFICACIÓN EN LA FUNCION GRAL_AREAS, SE AGREGO PARAMETRO idareausuario
CREATE OR REPLACE FUNCTION "MDB_GRAL"."GRAL_AREAS"(
	IN idareausuario INTEGER,
	OUT idarea integer,
	OUT txtarea text)
    RETURNS SETOF record 
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
    ROWS 1000
AS $BODY$
BEGIN
	RETURN QUERY
	SELECT "IDAREA", "TXTAREA"
	  FROM "MDB_GRAL"."GRAL_AREA"
	 WHERE "FLGACTI" = 1::text
	   AND "IDAREA" != idareausuario;
END;
$BODY$;

--- ARCHIVAR CONTACTO
CREATE OR REPLACE FUNCTION "MDB_CON"."CON_ARCHIVARCONTACTO"(
	IDCONTACTO INTEGER,
	TXTUSERNAME TEXT
	)
    RETURNS character varying
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
AS $BODY$

DECLARE
    _msj             CHARACTER VARYING;
BEGIN
    _msj := 'OK';
	UPDATE "MDB_CON"."CON_CONTACTOMOVIMIENTO"
	SET "TXTUSERARCHIVA" = TXTUSERNAME
	WHERE "IDMOVIMIENTO" = (SELECT MAX("IDMOVIMIENTO") FROM "MDB_CON"."CON_CONTACTOMOVIMIENTO" WHERE "IDCONTACTO" = IDCONTACTO);
	
	UPDATE "MDB_CON"."CON_CONTACTO"
	   SET "IDESTADO" = 40
	 WHERE "IDCONTACTO" = IDCONTACTO;
    RETURN _msj;
EXCEPTION
    WHEN OTHERS THEN
        GET STACKED DIAGNOSTICS _msj = PG_EXCEPTION_CONTEXT;
        SELECT CONCAT('Hubo un error: ', SQLERRM,' - ',SQLSTATE,' Stack: ',_msj) INTO _msj;
        RETURN _msj;
END

$BODY$;

-----------------------------------------
// DATOS VECINO
CREATE TYPE "MDB_CON"."DATOSVECINO_RESULT" AS
(
	"TXTCORREO" character varying(100),
	"NOMBRES" text
);

ALTER TYPE "MDB_CON"."DATOSVECINO_RESULT"
    OWNER TO postgres;

-- FUNCTION: "MDB_CON"."CON_MOVIMIENTOS"(integer, integer)

-- DROP FUNCTION "MDB_CON"."CON_MOVIMIENTOS"(integer, integer);

CREATE OR REPLACE FUNCTION "MDB_CON"."CON_DATOSVECINO"(
	IDCONTACTO integer)
    RETURNS SETOF "MDB_CON"."DATOSVECINO_RESULT" 
    LANGUAGE 'plpgsql'

    COST 100
    VOLATILE 
    ROWS 1000
AS $BODY$BEGIN
	RETURN QUERY
	SELECT "TXTCORREO",
		   INITCAP(CONCAT(c."TXTNOMPERSONA",' ',c."TXTAPEPATERNO",' ',c."TXTAPEMATERNO")) "NOMBRES"
	  FROM "MDB_CON"."CON_CONTACTO" c
	 WHERE c."IDCONTACTO" = IDCONTACTO;
END;
$BODY$;
*/

/*-- CONTACTO - Pase a producción

    TABLA "MDB_CON"."CON_CONTACTO"
    TABLA "MDB_CON"."CON_CONTACTOMOVIMIENTO"
    TABLA "MDB_GRAL"."GRAL_CORREOS"(CREAR CORREO ASIGNADO A CONTACTO)

    TYPE "MDB_CON"."CONTACTO_RESULT"
    TYPE "MDB_CON"."DATOSVECINO_RESULT"    
    FUNCTION "MDB_CON"."CON_ARCHIVARCONTACTO"
    FUNCTION "MDB_CON"."CON_ASIGNARAREA"
    FUNCTION "MDB_CON"."CON_DATOSVECINO"
    FUNCTION "MDB_CON"."CON_INSERTARCONTACTO"
    FUNCTION "MDB_CON"."CON_MOVIMIENTOS"
    FUNCTION "MDB_CON"."CON_RANDOMCONTACTO"
    FUNCTION "MDB_GRAL"."GRAL_COMBOPARAMETROS"

    INSERTS EN "MDB_GRAL"."GRAL_PARAMETROS"
    FLG CATEGORIA "MODULOS" (PARA TIPO CORREOS)
    FLG CATEGORIA "AREA_ADMIN"
    FLG CATEGORIA "CONTACTO" (PARA TIPO CONTACTO)
    FLG CATEGORIA "ESTADO_CONTACTO"
    FLG CATEGORIA "MEDIO"
    FLG CATEGORIA "DISTRITOS"

    ARCHIVOS:
        UTILS_HELPER
        M_UTILS
        M_LOGIN
        CONSTANTS
        CONTACTO (M,V,C,JS)

    SUNEDU
        ROUTES
        C_consulta_sunedo_grados
        V_consulta_sunedo_grados

    SIDEBAR (PERMISOS)
        C_PERMISOS
        V_PERMISOS
    
*/