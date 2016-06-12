AsmPhpFloBundle
==========
This bundle is based on [Henri Bergius](https://github.com/bergie) library [phpflo](https://github.com/bergie/phpflo) whose README I really suggest to read :-)
The intention for creating this bundle is an easier inclusion into e.g. symfony environments with the need for flow programming.
I had to rewrite part of the initial Network class to make use of a component registry to easily manage components via DIC. Also all component services should be defined as "public: false" to not clutter the DIC.

Installation
----
You can either just add via:
```bash
 $ composer.phar require asm/phpflo-bundle
```
**Attention:** This need minimum-stability: dev set on rootlevel
Otherwise you can first add phpflo and then the bundle.
```bash
 $ composer.phar require phpflo/phpflo dev-master
 $ composer.phar require asm/phpflo-bundle
```
This will first add phpflo with dev stability and the the bundle. This is due to composer's handling of stabilities for indirect dependencies.

Configuration
----

```php
<?php
    // AppKernel.php
    // ...
        $bundles = [
            // ...
            new Asm\PhpFloBundle\AsmPhpFloBundle(),
        ];
    // ...
```
After adding the bundle, you have a new factory service **asm_phpflo** which uses a registry of all your accordingly tagged services.
You can add components using following steps:

**Component class**
```php
<?php
namespace AppBundle\Component;

// AppBundle/Component/ReadFile.php

use PhpFlo\Component;
use PhpFlo\Port;

class ReadFile extends Component
{
    public function __construct()
    {
        $this->inPorts['source'] = new Port();
        $this->outPorts['out'] = new Port();
        $this->outPorts['error'] = new Port();

        $this->inPorts['source']->on('data', array($this, 'readFile'));
    }

    public function readFile($data)
    {
        // ...
    }
}
```
Keep in mind to exend the PhpFlo\Component or implement PhpFlo\ComponentInterface!

**service definition**
```yaml
# app/config/services.yml

services:
  app.read_file:
    public: false
    class: AppBundle\Component\ReadFile
    tags:
      - {name: asm_phpflo.component, alias: read_file}

```
You can name the service whatever you want: Only two important things are the tags. It needs name "asm_phpflo.component" to be found in compiler pass and the alias will be used as component name for the graph file.

**graph file** (app/config/my_graph.json)
```json
{
  "properties": {
    "name": "Count lines in a file"
  },
  "processes": {
    "ReadFile": {
      "component": "read_file"
    },
    "SplitbyLines": {
      "component": "split_str"
    },
    "CountLines": {
      "component": "counter"
    },
    "Display": {
      "component": "output"
    }
  },
  "connections": [
    {
      "src": {
        "process": "ReadFile",
        "port": "out"
      },
      "tgt": {
        "process": "SplitbyLines",
        "port": "in"
      }
    },
    {
      "src": {
        "process": "ReadFile",
        "port": "error"
      },
      "tgt": {
        "process": "Display",
        "port": "in"
      }
    },
    {
      "src": {
        "process": "SplitbyLines",
        "port": "out"
      },
      "tgt": {
        "process": "CountLines",
        "port": "in"
      }
    },
    {
      "src": {
        "process": "CountLines",
        "port": "count"
      },
      "tgt": {
        "process": "Display",
        "port": "in"
      }
    }
  ]
}
```
The builder will automatically search for the provided graph file in '''app/config''' - if you need subdirectories, you can provide the filename in the formate '''subdir/graph.json'''

Example
----
Within a symfony controller with access to the DIC, you can simply create a graph like this:

```php
<?php
    /** @var \Asm\PhpFloBundle\Flow\Builder $builder */
    $network = $this->get('asm_phpflo')
        ->fromFile('my_graph.json');

    $network->getGraph()
        ->addInitial(
            $this->getParameter('kernel.root_dir') . '/config/my_graph.json', "ReadFile", "source"
        );
```

License
----
AsmPhpFloBundle is licensed under the MIT license. See the [LICENSE](Resources/meta/LICENSE) for the full license text.
**Free Software, Hell Yeah!**
