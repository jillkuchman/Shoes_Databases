--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    title character varying
);


ALTER TABLE brands OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO "Guest";

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: brands_stores; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE brands_stores (
    id integer NOT NULL,
    brands_id integer,
    stores_id integer
);


ALTER TABLE brands_stores OWNER TO "Guest";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE brands_stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_stores_id_seq OWNER TO "Guest";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE brands_stores_id_seq OWNED BY brands_stores.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE stores OWNER TO "Guest";

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO "Guest";

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY brands_stores ALTER COLUMN id SET DEFAULT nextval('brands_stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY brands (id, title) FROM stdin;
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_id_seq', 203, true);


--
-- Data for Name: brands_stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY brands_stores (id, brands_id, stores_id) FROM stdin;
1	11	11
2	12	12
3	13	12
5	15	13
6	55	39
7	56	40
8	57	40
10	59	41
11	73	57
12	74	58
13	75	58
15	77	59
16	91	75
17	92	76
18	93	76
20	95	77
21	109	93
22	110	94
23	111	94
25	113	95
26	127	111
27	128	112
28	129	112
30	131	113
31	145	129
32	146	130
33	147	130
35	149	131
36	160	132
37	161	133
38	161	134
39	162	135
40	162	136
41	163	147
42	164	148
43	165	148
45	167	149
46	178	150
47	179	151
48	179	152
49	180	153
50	180	154
51	181	165
52	182	166
53	183	166
55	185	167
56	196	168
57	197	169
58	197	170
60	198	172
61	199	183
62	200	184
63	201	184
65	203	185
\.


--
-- Name: brands_stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('brands_stores_id_seq', 65, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY stores (id, name) FROM stdin;
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('stores_id_seq', 185, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: brands_stores_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY brands_stores
    ADD CONSTRAINT brands_stores_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: epicodus
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM epicodus;
GRANT ALL ON SCHEMA public TO epicodus;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

