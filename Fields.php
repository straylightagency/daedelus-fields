<?php

namespace Daedelus\Fields;

use Closure;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Builder register(?Closure $closure = null)
 * @method static Builder config(array $config)
 * @method static Builder onInit(Closure $closure)
 * @method static Builder disableAdmin(bool $value = true)
 * @method static Builder enableAdmin()
 * @method static Builder disableRestApi(bool $value = true)
 * @method static Builder enableRestApi()
 * @method static Builder restFormat(string $value)
 * @method static Builder restStandardFormat()
 * @method static Builder restLightFormat()
 * @method static array getConfigOf(string $config_name)
 * @method static void markForBuild(Location $location)
 * @method static Location location(string $name, string $key = null)
 * @method static Location postType(string $post_type, string $title, Closure $closure = null, string $key = null, bool $build = true)
 * @method static Location pageTemplate(string $template_name, string $title, Closure $closure = null, string $key = null, bool $build = true)
 * @method static Location optionsPage(string $title, Closure $closure = null, string $page = 'options', bool $build = true)
 * @method static Location taxonomy(string $taxonomy, string $title, Closure $closure = null, string $key = null, bool $build = true)
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Fields extends Facade
{
	/** @var string */
	const string all = 'all';

	/** @var string */
	const string accordion = 'accordion';

	/** @var string */
	const string boolean = 'true_false';

	/** @var string */
	const string buttonGroup = 'button_group';

	/** @var string */
	const string checkbox = 'checkbox';

	/** @var string */
	const string color = 'color_picker';

	/** @var string */
	const string date = 'date_picker';

	/** @var string */
	const string dateTime = 'date_time_picker';

	/** @var string */
	const string email = 'email';

	/** @var string */
	const string file = 'file';

	/** @var string */
	const string gallery = 'gallery';

	/** @var string */
	const string googleMap = 'google_map';

	/** @var string */
	const string image = 'image';

	/** @var string */
	const string link = 'link';

	/** @var string */
	const string message = 'message';

	/** @var string */
	const string number = 'number';

	/** @var string */
	const string oembed = 'oembed';

	/** @var string */
	const string pageLink = 'page_link';

	/** @var string */
	const string password = 'password';

	/** @var string */
	const string postObject = 'post_object';

	/** @var string */
	const string radio = 'radio';

	/** @var string */
	const string range = 'range';

	/** @var string */
	const string relationship = 'relationship';

	/** @var string */
	const string select = 'select';

	/** @var string */
	const string tab = 'tab';

	/** @var string */
	const string taxonomy = 'taxonomy';

	/** @var string */
	const string textarea = 'textarea';

	/** @var string */
	const string text = 'text';

	/** @var string */
	const string time = 'time_picker';

	/** @var string */
	const string url = 'url';

	/** @var string */
	const string user = 'user';

	/** @var string */
	const string wysiwyg = 'wysiwyg';

	/** @var string */
	const string flexible = 'flexible_content';

	/** @var string */
	const string group = 'group';

	/** @var string */
	const string layout = 'layout';

	/** @var string */
	const string location = 'location';

	/** @var string */
	const string repeater = 'repeater';

	/**
	 * @return string
	 */
	public static function getFacadeAccessor(): string
	{
		return FieldsManager::class;
	}
}