define({ "api": [
  {
    "type": "get",
    "url": "/categories/{placeID}/",
    "title": "get categories",
    "name": "get_Categories",
    "group": "Categories",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Categories.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{placeID}/wp",
    "title": "get categories from source",
    "name": "get_Categories_From_Source",
    "group": "Categories",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n        {\n        id: 22,\n        count: 79,\n        description: \"71\",\n        link: \"http://www.criticajalisco.com/categoria/ciencia/\",\n        name: \"Ciencia\",\n        slug: \"ciencia\",\n        taxonomy: \"category\",\n        parent: 0,\n        meta: [ ],\n        _links: {\n            self: [\n            {\n                href: \"http://www.criticajalisco.com/wp-json/wp/v2/categories/22\"\n            }\n            ],\n            collection: [\n                {\n                    href: \"http://www.criticajalisco.com/wp-json/wp/v2/categories\"\n                }\n            ],\n            about: [\n            {\n                href: \"http://www.criticajalisco.com/wp-json/wp/v2/taxonomies/category\"\n            }\n            ],\n            wp:post_type: [\n                {\n                    href: \"http://www.criticajalisco.com/wp-json/wp/v2/posts?categories=22\"\n                }\n            ],\n            curies: [\n                {\n                    name: \"wp\",\n                    href: \"https://api.w.org/{rel}\",\n                    templated: true\n                }\n                ]\n            }\n        },\n    ]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Categories.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{placeID}/top",
    "title": "get top categories",
    "name": "get_top_Categories",
    "group": "Categories",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Categories.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "/categories/{placeID}/wp/update",
    "title": "save categories from source in db",
    "name": "save_categories_from_source_in_db",
    "group": "Categories",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Categories.php",
    "groupTitle": "Categories"
  },
  {
    "type": "get",
    "url": "api/notifications/push/:postID",
    "title": "Push Notification by PostID",
    "name": "Send_Push_notifications_defined_by_the_postID",
    "group": "Notifications",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "postID",
            "description": ""
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n            {\n            message_id: {number}\n            }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Notifications.php",
    "groupTitle": "Notifications"
  },
  {
    "type": "get",
    "url": "api/notifications/push",
    "title": "custom Push Notification --Deprecated",
    "name": "send_Push_Notifications",
    "group": "Notifications",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "topic",
            "description": "<p>(optional) target of multipleClients</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>(optional) title of push Notifications</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "body",
            "description": "<p>(optional) body of push Notifications</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "icon",
            "description": "<p>(optional) icon img of push Notifications</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "click_action",
            "description": "<p>(optional) event on click (url)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "to",
            "description": "<p>(optional) singular target of push (gets override by topics)</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n            {\n            message_id: {number}\n            }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Notifications.php",
    "groupTitle": "Notifications"
  },
  {
    "type": "get",
    "url": "api/places/loc/",
    "title": "get place data by coordinates",
    "name": "Codes_by_location",
    "group": "Places",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lat",
            "description": "<p>latitude coordinates</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lon",
            "description": "<p>longitude coordinates</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 52,\n  country: \"MEX\",\n  place: \"Aguascalientes\",\n  url: \"http://www.aguascalientespublica.com/\",\n  created_at: \"2017-05-25 23:09:19\",\n  updated_at: \"2017-05-25 23:09:20\"\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Places.php",
    "groupTitle": "Places"
  },
  {
    "type": "get",
    "url": "api/places/country/{country?}",
    "title": "get the  \"places\"",
    "name": "Place_by_country",
    "group": "Places",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "country",
            "description": "<p>the first 3 chars country name {3}</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 52,\n  country: \"MEX\",\n  place: \"Aguascalientes\",\n  url: \"http://www.aguascalientespublica.com/\",\n  created_at: \"2017-05-25 23:09:19\",\n  updated_at: \"2017-05-25 23:09:20\"\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Places.php",
    "groupTitle": "Places"
  },
  {
    "type": "get",
    "url": "api/places/",
    "title": "get all the  \"places\"",
    "name": "all_Places",
    "group": "Places",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 52,\n  country: \"MEX\",\n  place: \"Aguascalientes\",\n  url: \"http://www.aguascalientespublica.com/\",\n  created_at: \"2017-05-25 23:09:19\",\n  updated_at: \"2017-05-25 23:09:20\"\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Places.php",
    "groupTitle": "Places"
  },
  {
    "type": "post",
    "url": "api/places/bulk",
    "title": "set multiple \"places\"",
    "name": "setPlaces",
    "group": "Places",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "json",
            "description": "<p>with URL,country and place.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "true",
            "description": "<p>return true if success.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/Places.php",
    "groupTitle": "Places"
  },
  {
    "type": "get",
    "url": "api/places/{placeID}/posts/{postID?}",
    "title": "get posts by placeID",
    "name": "Posts_by_placeID",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n    [\n        {\n            id: 4591,\n            date: \"2016-07-26 10:26:04\",\n            place: 65,\n            title: \"Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong\",\n            content: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> \",\n            excerpt: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> \",\n            categories: \"[2]\",\n            full: \"http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png\",\n            thumbnail: \"\",\n            created_at: null,\n            updated_at: null\n        }\n    ]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/places/:placeID/wposts",
    "title": "get posts by placeID",
    "name": "Posts_by_placeID",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 3698,\n        date: \"2017-05-28T00:28:55\",\n        date_gmt: \"2017-05-28T03:13:28\",\n        guid: {\n            rendered: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\"\n        },\n        modified: \"2017-05-28T00:28:55\",\n        modified_gmt: \"2017-05-28T05:28:55\",\n        slug: \"tras-reunion-g7-concluyen-estrategia-cambio-climatico\",\n        status: \"publish\",\n        type: \"post\",\n        link: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\",\n        title: {\n            rendered: \"Tras reunión G7 no concluyen estrategia para el cambio climático\"\n        },\n        content: {\n            rendered: \"demo\"\n            protected: false\n            }\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/posts/{placeID}/category/id/{categoryID}",
    "title": "get Post by Category ID",
    "name": "get_Post_by_Category_ID",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n    [\n        {\n            id: 4591,\n            date: \"2016-07-26 10:26:04\",\n            place: 65,\n            title: \"Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong\",\n            content: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> \",\n            excerpt: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> \",\n            categories: \"[2]\",\n            full: \"http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png\",\n            thumbnail: \"\",\n            created_at: null,\n            updated_at: null\n        }\n    ]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/posts",
    "title": "get posts",
    "name": "get_Posts",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n        {\n            id: 4591,\n            date: \"2016-07-26 10:26:04\",\n            place: 65,\n            title: \"Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong\",\n            content: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> \",\n            excerpt: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> \",\n            categories: \"[2]\",\n            full: \"http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png\",\n            thumbnail: \"\",\n            created_at: null,\n            updated_at: null\n        }\n    ]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/posts/location",
    "title": "get Post by cordinates",
    "name": "get_Posts_by_Cordinates",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lat",
            "description": "<p>latitude coordinates</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lon",
            "description": "<p>longitude coordinates</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n    [\n        {\n            id: 4591,\n            date: \"2016-07-26 10:26:04\",\n            place: 65,\n            title: \"Coadyuvará Segob para esclarecer asesinato de alcaldes: Chong\",\n            content: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes del Ayuntamiento.</p> <p>El encargado de la política interna del país, sostuvo que se trata de actos de violencia que no pueden ser tolerados, por lo que advirtió que se irá tras los responsables.</p> <p>&#8220;Aunque por causas distintas, se trata de actos que simple y sencillamente no pueden ser tolerados en nuestro país&#8221;, señaló Osorio Chong.</p> <p>Agregó que &#8220;el gobierno de la República coadyuvará con los gobiernos estatales para identificar y detener a los responsables&#8221;.<br /> De igual forma, expresó sus condolencias y solidaridad a los familiares y amigos de los alcaldes e integrantes de los ayuntamientos que perdieron la vida.<br /> Osorio Chong indicó que al mismo tiempo seguirá el trabajo coordinado con los Poderes de la Unión, y los otros órdenes de gobierno para avanzar en el fortalecimiento de las instituciones locales de seguridad.</p> \",\n            excerpt: \"<p>Miguel Ángel Osorio Chong, secretario de Gobernación, condenó categóricamente los lamentables hechos de violencia ocurridos el fin de semana en Chiapas y en los límites de Guerrero y Michoacán donde fueron asesinados los alcaldes de San Juan Chamula, Domingo López Gonzales, y en Pungarabato, Guerrero, Ambrosio Soto Duarte, y más de una decena de integrantes [&hellip;]</p> \",\n            categories: \"[2]\",\n            full: \"http://www.criticajalisco.com/wp-content/uploads/sites/27/2016/07/segob.png\",\n            thumbnail: \"\",\n            created_at: null,\n            updated_at: null\n        }\n    ]",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/places/{placeID}/wposts/update",
    "title": "update post by place",
    "name": "update_Post_by_placeID",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 3698,\n        date: \"2017-05-28T00:28:55\",\n        date_gmt: \"2017-05-28T03:13:28\",\n        guid: {\n            rendered: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\"\n        },\n        modified: \"2017-05-28T00:28:55\",\n        modified_gmt: \"2017-05-28T05:28:55\",\n        slug: \"tras-reunion-g7-concluyen-estrategia-cambio-climatico\",\n        status: \"publish\",\n        type: \"post\",\n        link: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\",\n        title: {\n            rendered: \"Tras reunión G7 no concluyen estrategia para el cambio climático\"\n        },\n        content: {\n            rendered: \"demo\"\n            protected: false\n            }\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "api/places/{placeID}/wposts/update/all",
    "title": "update all posts by place",
    "name": "update_all_Posts_by_placeID",
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  id: 3698,\n        date: \"2017-05-28T00:28:55\",\n        date_gmt: \"2017-05-28T03:13:28\",\n        guid: {\n            rendered: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\"\n        },\n        modified: \"2017-05-28T00:28:55\",\n        modified_gmt: \"2017-05-28T05:28:55\",\n        slug: \"tras-reunion-g7-concluyen-estrategia-cambio-climatico\",\n        status: \"publish\",\n        type: \"post\",\n        link: \"http://www.nuevayorkpublica.com/tras-reunion-g7-concluyen-estrategia-cambio-climatico/\",\n        title: {\n            rendered: \"Tras reunión G7 no concluyen estrategia para el cambio climático\"\n        },\n        content: {\n            rendered: \"demo\"\n            protected: false\n            }\n  }",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/Posts.php",
    "groupTitle": "Post"
  }
] });
