<?php

namespace Gedmo\Sluggable\Handler;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Gedmo\Exception\InvalidMappingException;
use Gedmo\Sluggable\Mapping\Event\SluggableAdapter;
use Gedmo\Sluggable\SluggableListener;

/**
 * Interface defining a handler for the sluggable behavior.
 * Usage is intended only for internal access of the
 * Sluggable extension and should not be used elsewhere.
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
interface SlugHandlerInterface
{
    /**
     * Create a new handler instance
     */
    public function __construct(SluggableListener $sluggable);

    /**
     * Hook on slug handlers before the decision is made whether
     * the slug needs to be recalculated.
     *
     * @param object $object
     * @param string $slug
     * @param bool   $needToChangeSlug
     *
     * @return void
     */
    public function onChangeDecision(SluggableAdapter $ea, array &$config, $object, &$slug, &$needToChangeSlug);

    /**
     * Hook on slug handlers called after the slug is built.
     *
     * @param object $object
     * @param string $slug
     *
     * @return void
     */
    public function postSlugBuild(SluggableAdapter $ea, array &$config, $object, &$slug);

    /**
     * Hook for slug handlers called after the slug is completed.
     *
     * @param object $object
     * @param string $slug
     *
     * @return void
     */
    public function onSlugCompletion(SluggableAdapter $ea, array &$config, $object, &$slug);

    /**
     * @return bool Whether this handler has already urlized the slug
     */
    public function handlesUrlization();

    /**
     * Validates the options for the handler.
     *
     * @throws InvalidMappingException if the configuration is invalid
     */
    public static function validate(array $options, ClassMetadata $meta);
}
