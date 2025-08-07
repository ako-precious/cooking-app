<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $stripe_account_id
 * @property int $charges_enabled
 * @property int $transfer_enabled
 * @property int $detailed_submitted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereChargesEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDetailedSubmitted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereStripeAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereTransferEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUserId($value)
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $badge_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereBadgePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Badge whereUpdatedAt($value)
 */
	class Badge extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $meal_schedule_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereMealScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserId($value)
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $certificate
 * @property string|null $means_of_id
 * @property string|null $other_info
 * @property string $status
 * @property string|null $availability
 * @property string|null $question1
 * @property string|null $question2
 * @property string|null $question3
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $meals
 * @property-read int|null $meals_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CookFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Cook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cook query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereMeansOfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereOtherInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereQuestion1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereQuestion2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereQuestion3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cook whereUserId($value)
 */
	class Cook extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cook_id
 * @property string|null $name
 * @property string|null $region
 * @property string|null $description
 * @property array|null $prices
 * @property array|null $ingredients
 * @property array|null $tags
 * @property int $cooking_limit
 * @property string $status
 * @property string $ordering_preferences
 * @property string $serving_style
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cook $cook
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MealPhotos> $mealPhotos
 * @property-read int|null $meal_photos_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MealSchedule> $meal_schedule
 * @property-read int|null $meal_schedule_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Meal> $rating
 * @property-read int|null $rating_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\MealFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCookingLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereIngredients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereOrderingPreferences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal wherePrices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereServingStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meal whereUpdatedAt($value)
 */
	class Meal extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_id
 * @property string $meal_photo_path
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meal $meal
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos query()
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereMealPhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealPhotos whereUpdatedAt($value)
 */
	class MealPhotos extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_id
 * @property int $user_id
 * @property string $meal_time
 * @property \Illuminate\Support\Carbon $start_date
 * @property string|null $address
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $portion
 * @property array|null $prices
 * @property-read \App\Models\Meal $meal
 * @property-read \App\Models\orders|null $order
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\MealScheduleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereMealTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule wherePortion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule wherePrices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MealSchedule whereUserId($value)
 */
	class MealSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUserId($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $meal_schedule_id
 * @property string $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMealScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $subscribable_type
 * @property int $subscribable_id
 * @property string $endpoint
 * @property string|null $public_key
 * @property string|null $auth_token
 * @property string|null $content_encoding
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereAuthToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereContentEncoding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereEndpoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription wherePublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereSubscribableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereSubscribableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PushSubscription whereUserId($value)
 */
	class PushSubscription extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_id
 * @property int $user_id
 * @property int $presentation
 * @property int $taste
 * @property int $value
 * @property int $nutrition
 * @property int $portion_size
 * @property int $freshness
 * @property int $total
 * @property string $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meal $meal
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereFreshness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereNutrition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePortionSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating wherePresentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereTaste($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rating whereValue($value)
 */
	class Rating extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property int $user_id
 * @property string $content
 * @property string $category
 * @property string|null $post_photo_path
 * @property string $read_time
 * @property string $slug
 * @property int $useful
 * @property int $useless
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource wherePostPhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUseful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUseless($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUserId($value)
 */
	class Resource extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property bool $personal_team
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TeamInvitation> $teamInvitations
 * @property-read int|null $team_invitations_count
 * @property-read \App\Models\Membership $membership
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team wherePersonalTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUserId($value)
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $team_id
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team $team
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamInvitation whereUpdatedAt($value)
 */
	class TeamInvitation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $facebook_id
 * @property string|null $google_id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $address
 * @property string|null $status
 * @property string|null $phone_number
 * @property string|null $means_of_id
 * @property array|null $dietary_restrictions_allergies
 * @property string|null $other_info
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $continent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chat> $Chat
 * @property-read int|null $chat_count
 * @property-read \App\Models\Cook|null $cook
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $meals
 * @property-read int|null $meals_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read string $profile_photo_url
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContinent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDietaryRestrictionsAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMeansOfId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOtherInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereMealId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wishlist whereUserId($value)
 */
	class Wishlist extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $meal_schedule_id
 * @property int $user_id
 * @property float $total_price
 * @property string $status
 * @property string $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MealSchedule|null $mealSchedule
 * @method static \Illuminate\Database\Eloquent\Builder|orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereMealScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|orders whereUserId($value)
 */
	class orders extends \Eloquent {}
}

