# Image Resizer

- [Introduction](#introduction)
- [Resize from path](#string)
- [Resize from variable](#variable)
- [Additional Options](#options)
- [Usage in PHP](#php)
- [Usage in Backend List](#php)

<a name="introduction"></a>
## Introduction

Resizes an image to the required dimensions. It accepts a string with a file path to the image or a `October\Rain\Database\Attach\File` object (you will have one of these if you have used the attachOne or AttachMany relationship)

Please note, the not found image can be overwritten via the settings in the admin area.

<a name="string"></a>
## Using a string

Please note, if the filter alters the URL, you must apply resize afterwards

```
{{ 'assets/graphics/background.jpg' | theme | resize(500,500) }}
```

<a name="variable"></a>
## Using a variable

```
{{ property.image | resize(500) }}
```

<a name="options"></a>
## With more options

See list of options below

```
{{ property.image | resize(500, false, { mode: 'crop', quality: '80', extension: 'png' }) }}
```

Key | Description | Default | Options
--- | --- | --- | ---
mode | How the image should be fitted to dimensions | auto | exact, portrait, landscape, auto, crop
offset | Offset the resized image | [0,0] | [int, int]
extension | The extension on the image to return | auto | auto, jpg, jpeg, gif, png
quality | The quality of compression _*requires cache clear_ | 95 | 0-100
sharpen | Sharpen the image across a scale of 0 - 100 _*requires cache clear_ | 0 | 0-100

<a name="php"></a>
## Usage in PHP

The image resizer can also be used easily in PHP, as follows:

```
use ToughDeveloper\ImageResizer\Classes\Image;

$image = new Image('/path/to/image.jpg');
$image->resize(150, 200, [ 'mode' => 'crop' ]);
```

<a name="backendList"></a>
## Usage in Backend List

The image resizer can also be used on backend lists with the type of `thumb`, e.g.

```
image:
	label: Image
	type: thumb
```

This works with:

 - AttachMany (uses first image) [Docs](https://ochttps://stackedit.io/editor#tobercms.com/docs/backend/forms#widget-fileupload)
 - AttachOne [Docs](https://ochttps://stackedit.io/editor#tobercms.com/docs/backend/forms#widget-fileupload)
 - Mediafinder [Docs](https://octobercms.com/docs/backend/forms#widget-mediafinder)

You can also optionally pass width (default 50), height (default 50) and options as follows:

```
image:
	label: Image
	type: thumb
	width: 75
	height: 100
	options:
		mode: crop
```