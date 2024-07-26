<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Validator\Tests\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\AbstractComparison;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @author Jan Schädlich <jan.schaedlich@sensiolabs.de>
 */
class GreaterThanOrEqualValidatorWithPositiveOrZeroConstraintTest extends GreaterThanOrEqualValidatorTest
{
    protected static function createConstraint(?array $options = null): Constraint
    {
        return new PositiveOrZero($options);
    }

    public static function provideValidComparisons(): array
    {
        return [
            [0, 0],
            [1, 0],
            [2, 0],
            [2.5, 0],
            ['0', '0'],
            ['333', '0'],
            [null, 0],
        ];
    }

    public static function provideInvalidComparisons(): array
    {
        return [
            [-1, '-1', 0, '0', 'int'],
            [-2, '-2', 0, '0', 'int'],
            [-2.5, '-2.5', 0, '0', 'int'],
        ];
    }

    public function testThrowsConstraintExceptionIfPropertyPath()
    {
        $this->expectException(ConstraintDefinitionException::class);
        $this->expectExceptionMessage('The "propertyPath" option of the "Symfony\Component\Validator\Constraints\PositiveOrZero" constraint cannot be set.');

        return new PositiveOrZero(['propertyPath' => 'field']);
    }

    public function testThrowsConstraintExceptionIfValue()
    {
        $this->expectException(ConstraintDefinitionException::class);
        $this->expectExceptionMessage('The "value" option of the "Symfony\Component\Validator\Constraints\PositiveOrZero" constraint cannot be set.');

        return new PositiveOrZero(['value' => 0]);
    }

    /**
     * @dataProvider provideInvalidConstraintOptions
     */
    public function testThrowsConstraintExceptionIfNoValueOrPropertyPath($options)
    {
        $this->markTestSkipped('Value option always set for PositiveOrZero constraint');
    }

    public function testThrowsConstraintExceptionIfBothValueAndPropertyPath()
    {
        $this->markTestSkipped('Value option is set for PositiveOrZero constraint automatically');
    }

    public function testInvalidValuePath()
    {
        $this->markTestSkipped('PropertyPath option is not used in PositiveOrZero constraint');
    }

    public static function provideAllValidComparisons(): array
    {
        self::markTestSkipped('The "value" option cannot be used in the PositiveOrZero constraint');
    }

    /**
     * @dataProvider provideValidComparisonsToPropertyPath
     */
    public function testValidComparisonToPropertyPath($comparedValue)
    {
        $this->markTestSkipped('PropertyPath option is not used in PositiveOrZero constraint');
    }

    public function testNoViolationOnNullObjectWithPropertyPath()
    {
        $this->markTestSkipped('PropertyPath option is not used in PositiveOrZero constraint');
    }

    /**
     * @dataProvider throwsOnInvalidStringDatesProvider
     */
    public function testThrowsOnInvalidStringDates(AbstractComparison $constraint, $expectedMessage, $value)
    {
        $this->markTestSkipped('The compared value cannot be an invalid string date because it is hardcoded to 0.');
    }

    public function testInvalidComparisonToPropertyPathAddsPathAsParameter()
    {
        $this->markTestSkipped('PropertyPath option is not used in PositiveOrZero constraint');
    }

    public static function throwsOnInvalidStringDatesProvider(): array
    {
        self::markTestSkipped('The "value" option cannot be used in the PositiveOrZero constraint');
    }

    public static function provideAllInvalidComparisons(): array
    {
        self::markTestSkipped('The "value" option cannot be used in the Negative constraint');
    }

    public static function provideComparisonsToNullValueAtPropertyPath(): array
    {
        self::markTestSkipped('PropertyPath option is not used in PositiveOrZero constraint');
    }
}
